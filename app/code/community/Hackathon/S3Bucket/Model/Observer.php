<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * PHP Version 5.5
 *
 * @category  Hackathon
 * @package   Hackathon_S3Bucket
 * @author    Andreas Emer <emer AT mothership.de>
 * @author    Alexander Turiak <turyak AT gmail.com>
 * @copyright Copyright (c) 2015 Hackathon
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @link      http://mage-hackathon.de
 */

require_once 'AWS/S3.php';


class Hackathon_S3Bucket_Model_Observer extends Varien_Object
{

    function uploadMediaFiles($observer) {

        $awsAccessKey = Mage::helper('hackathon_s3bucket')->getAccessKeyId();
        $awsSecretKey = Mage::helper('hackathon_s3bucket')->getSecretAccessKey();

        $awsEndPoint  = Mage::helper('hackathon_s3bucket')->getEndpoint();
        $s3bucketName = Mage::helper('hackathon_s3bucket')->getBucket();

        $productImages = $observer->getEvent()->getImages();
        $ProductImagesMediaPath = Mage::getSingleton('catalog/product_media_config');


        $s3 = new S3($awsAccessKey, $awsSecretKey);
        $s3->setEndpoint($awsEndPoint);

        foreach($productImages['images'] as $mediaFileName)
        {

            $productImagePath = $ProductImagesMediaPath->getMediaPath($mediaFileName['file']);


            $s3->putObject(
                $s3->inputFile($productImagePath, false),
                $s3bucketName,
                'media/catalog/product' . $mediaFileName['file'],
                $s3::ACL_PUBLIC_READ);
        }
        


    }


}