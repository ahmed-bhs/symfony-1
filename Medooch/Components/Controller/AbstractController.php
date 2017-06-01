<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/29/17
 * Time: 13:47
 * @author: Mobelite <http://www.mobelite.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Components\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class AbstractController
 * @package Components\Controller
 */
abstract class AbstractController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{
    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param $key
     * @param array $parameters
     * @param $file
     * ---------------------------------------
     * **************** Function output: ****************
     * @return string
     * ---------------------------------------
     */
    public function trans($key, array $parameters = [], $file): string
    {
        return $this->get('translator')->trans($key, $parameters, $file);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function input: ****************
     * @param array $options
     * ---------------------------------------
     * **************** Function output: ****************
     * @return int
     * ---------------------------------------
     */
    public function sendMail(array $options): int
    {
        if (!$this->has('mailer.helper')) {
            throw new Exception('Mailer helper is not defined.');
        }
        return $this->get('mailer.helper')->sendEmail($options);
    }

    /**
     * ---------------------------------------
     * @author: contact[at]mobelite.fr
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Change Entity Status by proprety
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $class
     * @param string $proprety
     * @param string $identifier
     * ---------------------------------------
     * **************** Function output: ****************
     * @return bool
     * ---------------------------------------
     */
    public function changeEntityStatus(string $class, string $proprety, string $identifier): bool
    {
        $entity = $this->get($class . '.repository')->byToken($identifier);
        if (!$entity) {
            throw $this->createNotFoundException($this->trans('not_found', [], ucfirst($class)));
        }
        $getter = 'get' . ucfirst($proprety);
        $setter = 'set' . ucfirst($proprety);
        $entity->$setter(!$entity->$getter());
        $this->addFlash('success', $this->trans(strtolower($proprety) . '_row_changed', [], 'messages'));
        $this->get($class.'.manager')->update($entity);
        return true;
    }
}