<?php

require_once 'abstract.php';

class S3Sync extends Mage_Shell_Abstract
{
    public function _construct()
    {
        $this->_appCode = 'german';
        parent::_construct();
    }

    public function run()
    {
        /** @var Hackathon_S3Bucket_Helper_Data $helper */
        $helper = Mage::helper('hackathon_s3bucket');

        if (!$helper->validateCredentials()) {
            echo 'Please fill in all the S3 credentials' . PHP_EOL;
            return;
        }

        Zend_Service_Amazon_S3::setKeys($helper->getAccessKeyId(), $helper->getSecretAccessKey());
        $bucketName = $helper->getBucketName();
        $s3 = new Zend_Service_Amazon_S3();
        $s3->setEndPoint($helper->getEndpoint());

        // Load images from a product
        // Mage::getModel('catalog/product_media_config')->getMediaUrl();
        $productGallery = Mage::getModel('catalog/product')->load(54)->getMediaGalleryImages();
        foreach ($productGallery as $galleryImage) {
            if ($s3->putFile(
                $galleryImage->getPath(),
                $bucketName . '/gallery' . $galleryImage->getFile(),
                array(
                    Zend_Service_Amazon_S3::S3_ACL_HEADER => Zend_Service_Amazon_S3::S3_ACL_PUBLIC_READ
                )
            )) {
                echo 'File ' . basename($galleryImage->getFile()) . ' was uploaded' . PHP_EOL;
            } else {
                echo 'Error uploading file ' . basename($galleryImage->getFile()) . '!' . PHP_EOL;
            }
        }

    }
}

$sync = new S3Sync();
$sync->run();