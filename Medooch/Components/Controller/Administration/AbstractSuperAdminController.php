<?php
/**
 * This file is part of the Final-Safe.
 * Created by trimechmehdi.
 * Date: 5/26/17
 * Time: 15:29
 * @author: Trimech Mehdi <trimechmehdi11@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Medooch\Components\Controller\Administration;
use Components\Controller\AbstractController;

/**
 * Class AbstractSuperAdminController
 * @package AppWeb
 */
abstract class AbstractSuperAdminController extends AbstractController
{
    /**
     * Gets a container service by its id.
     *
     * @param string $id The service id
     *
     * @return object The service
     */
    public function get($id)
    {
        /**
         * check if the user allowed to routes
         */
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            throw $this->createAccessDeniedException('Access denied');
        }

        return parent::get($id);
    }
}