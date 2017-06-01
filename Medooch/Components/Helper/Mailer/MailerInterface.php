<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/29/17
 * Time: 10:55
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Helper\Mailer;

/**
 * Class MailerInterface
 * @package Components\Helper\Mailer
 */
interface MailerInterface
{
    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
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
    public function sendEmail(array $options): int;
}