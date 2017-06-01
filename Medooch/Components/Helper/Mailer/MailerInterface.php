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

namespace Medooch\Components\Helper\Mailer;

/**
 * Class MailerInterface
 * @package Medooch\Components\Helper\Mailer
 */
interface MailerInterface
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
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