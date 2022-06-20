<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace  Crocoit\Post\Setup;
 
use Crocoit\Post\Model\Department;
use Crocoit\Post\Model\Post;
use Crocoit\Post\Model\DepartmentPosts;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
 
    protected $_department;
    protected $_post;
    protected $_departmentPosts;
 
    public function __construct(Department $department, Post $post , DepartmentPosts $departmentPosts){
        $this->_department = $department;
        $this->_post = $post;
        $this->_departmentPosts = $departmentPosts;
    }
 
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
 
        // Action to do if module version is less than 1.0.0.3
        if (version_compare($context->getVersion(), '1.0.0.3') < 0) {
            $departments = [
                [
                    'name' => 'Marketing',
                    'description' => 'Sed cautela nimia in peiores haeserat plagas, ut narrabimus postea,
                aemulis consarcinantibus insidias graves apud Constantium, cetera medium principem sed
                siquid auribus eius huius modi quivis infudisset ignotus, acerbum et inplacabilem et in
                hoc causarum titulo dissimilem sui.'
                ],
                [
                    'name' => 'Technical Support',
                    'description' => 'Post hanc adclinis Libano monti Phoenice, regio plena gratiarum et
                venustatis, urbibus decorata magnis et pulchris; in quibus amoenitate celebritateque
                nominum Tyros excellit, Sidon et Berytus isdemque pares Emissa et Damascus saeculis condita
                priscis.'
                ],
                [
                    'name' => 'Human Resource',
                    'description' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.'
                ]
            ];
 
            /**
             * Insert departments
             */
            $departmentsIds = array();
            foreach ($departments as $data) {
                $department = $this->_department->setData($data)->save();
                $departmentsIds[] = $department->getId();
            }
 
 
            $posts = [
                [
                    'title' => 'Sample Marketing Post 1',
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                                discessit.'
                ],
                [
                    'title' => 'Sample Marketing Post 2', 
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.' 
                ],
                [
                    'title' => 'Sample Technical Support Post 1', 
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.' 
                ],
                [
                    'title' => 'Sample Human Resource Post 1', 
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.' 
                ],
                [
                    'title' => 'Sample multi Post 1', 
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.' 
                ],
                [
                    'title' => 'Sample multi Post 2', 
                    'content' => 'Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox
                interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore,
                discessit.' 
                ]
            ];

             /**
             * Insert posts
             */
            $postIds = array();
            foreach ($posts as $data) {
                $post = $this->_post->setData($data)->save(); 
                $departmentPostsData['post_id'] = $post->getId();
                $departmentPostsData['department_id'] = $departmentsIds[random_int(0,2)];
                $this->_departmentPosts->setData($departmentPostsData)->save();
            } 
        }
 
        $installer->endSetup();
    }
}