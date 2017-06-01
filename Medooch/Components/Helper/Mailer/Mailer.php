<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/29/17
 * Time: 10:56
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Helper\Mailer;

use Components\Validate;
use Monolog\Logger;
use Shared\Constraints\EmailEiffage;
use Swift_Message as Message;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class Mailer
 * @package Medooch\Components\Helper\Mailer
 */
class Mailer implements MailerInterface
{
    /**
     * @var
     */
    private $mailer;
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var bool
     */
    private $debug = false;

    /**
     * @var array
     */
    private $options = [];

    /**
     * @var array
     */
    private $configuration = [];

    /**
     * @var Logger
     */
    private $logger;

    /**
     * Mailer constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->mailer = $container->get('mailer');
        $this->debug = $container->getParameter('kernel.debug');
        $this->logger = $container->get('logger');
        $this->configuration = [$container->getParameter('sender_mailer'), $container->getParameter('support_mailer')];
        $this->container = $container;
    }

    /**
     * @return boolean
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $view
     * @param array $parameters
     * ---------------------------------------
     * **************** Function output: ****************
     * @return mixed|string
     * ---------------------------------------
     */
    public function render($view, array $parameters = [])
    {
        return $this->container->get('twig')->render($view, $parameters);
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function Example: ****************
     * $this->mailer->sendEmail([
     * 'recipient' => $user->getEmailCanonical(),
     * 'subject' => 'Test',
     * 'template' => '@FOSUser/Resetting/reset_password_request_sent.html.twig'
     * ]);
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Send Mail with SwiftMailer
     * ---------------------------------------
     * **************** Function input: ****************
     * @param array $options
     * ---------------------------------------
     * **************** Function output: ****************
     * @return int
     * @throws \Exception
     * ---------------------------------------
     */
    public function sendEmail(array $options): int
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($options);

        $message = $this->createMessage();

        try {
            $sent = $this->mailer->send($message);
            if ($this->debug) {
                $this->logger->info('(' .
                    count($this->options['recipient']) .
                    ') Mail sent to users '
                );
            }
            return $sent;
        } catch (\Exception $e) {
            if ($this->debug) {
                $this->logger->error($e->getCode() . ' : An error was occured during the sending of email. Reason : ' . $e->getMessage());
                throw $e;
            }
        }

        return 0;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function output: ****************
     * @return Message
     * ---------------------------------------
     */
    public function createMessage(): Message
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->options['subject'])
            ->setFrom($this->options['from'])
            ->setTo($this->options['recipient'])
            ->setBcc($this->options['bcc']);

        $this->setBody($message, $this->options['template'], $this->options['parameters']);

        foreach ($this->options['attachments'] as $file) {
            $message->attach($this->createAttachment($file));
        }

        return $message;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param OptionsResolver $resolver
     * ---------------------------------------
     */
    private function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired([
            'recipient',
            'subject',
            'template',
        ]);

        $resolver->setDefault('from', $this->configuration[0]);
        $resolver->setDefault('bcc', [$this->configuration[1]]);
        $resolver->setDefault('parameters', []);
        $resolver->setDefault('attachments', []);

        $resolver->setAllowedTypes('recipient', ['string', 'array']);
        $resolver->setAllowedTypes('bcc', ['string', 'array']);
//        $resolver->setAllowedTypes('reply_to', ['string', 'array']);
        $resolver->setAllowedTypes('subject', ['string']);
        $resolver->setAllowedTypes('template', ['string']);
        $resolver->setAllowedTypes('parameters', ['array']);
        $resolver->setAllowedTypes('attachments', ['array']);
        $resolver->setAllowedTypes('from', 'string');
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function documentation: ****************
     * check if the email is valid
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $email
     * ---------------------------------------
     * **************** Function output: ****************
     * @return bool
     * ---------------------------------------
     */
    private function isEmailValid(string $email): bool
    {
        $validator = Validate::validate($email, new NotBlank());
        if ($validator->count()) return false;
        $validator = Validate::validate($email, new Email());
        if ($validator->count()) return false;
        $validator = Validate::validate($email, new EmailEiffage());
        if ($validator->count()) return false;

        return true;
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $path
     * ---------------------------------------
     * **************** Function output: ****************
     * @return \Swift_Mime_Attachment
     * ---------------------------------------
     */
    private function createAttachment(string $path): \Swift_Mime_Attachment
    {
        return \Swift_Attachment::fromPath($path);
    }

    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
     * ---------------------------------------
     * **************** Function input: ****************
     * @param Message $message
     * @param string $template
     * @param array $parameters
     * ---------------------------------------
     */
    private function setBody(Message $message, string $template, array $parameters = [])
    {
        $body = $this->render($template, array_merge($this->options, $parameters));
        $message->setBody($body, 'text/html');
    }
}