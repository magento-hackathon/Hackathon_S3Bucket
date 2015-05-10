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
class Hackathon_S3Bucket_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_AWS_REGION     = 'system/s3bucket/aws_region';
    const XML_PATH_S3_BUCKET      = 'system/s3bucket/aws_s3_bucketname';
    const XML_PATH_AWS_ACCESS_KEY = 'system/s3bucket/aws_access_key';
    const XML_PATH_AWS_SECRET_KEY = 'system/s3bucket/aws_secret_key';

    /**
     * Returns S3 endpoint based on region
     *
     * @return bool|string
     */
    public function getEndpoint()
    {
        $awsRegion = Mage::getStoreConfig(self::XML_PATH_AWS_REGION);

        if (empty($awsRegion)) {
            return false;
        }

        return sprintf('s3-%s.amazonaws.com', $awsRegion);
    }

    /**
     * Returns S3 bucket name
     *
     * @return bool|string
     */
    public function getBucket()
    {
        $bucket = Mage::getStoreConfig(self::XML_PATH_S3_BUCKET);

        if (empty($bucket)) {
            return false;
        }

        return $bucket;
    }

    /**
     * Returns region name
     *
     * @return bool|string
     */
    public function getRegion()
    {
        $regionName = Mage::getStoreConfig(self::XML_PATH_AWS_REGION);
        if (empty($regionName)) {
            return false;
        }

        return $regionName;
    }

    /**
     * Returns access key id
     *
     * @return bool|string
     */
    public function getAccessKeyId()
    {
        $awsAccessKey = Mage::getStoreConfig(self::XML_PATH_AWS_ACCESS_KEY);
        if (empty($awsAccessKey)) {
            return false;
        }

        return Mage::helper('core')->decrypt($awsAccessKey);
    }

    /**
     * Returns secret access key
     *
     * @return bool|string
     */
    public function getSecretAccessKey()
    {
        $awsSecretKey = Mage::getStoreConfig(self::XML_PATH_AWS_SECRET_KEY);
        if (empty($awsSecretKey)) {
            return false;
        }

        return Mage::helper('core')->decrypt($awsSecretKey);
    }

    /**
     * Returns bucket name
     *
     * @return bool|string
     */
    public function getBucketName()
    {
        $bucketName = Mage::getStoreConfig(self::XML_PATH_S3_BUCKET);
        if (empty($bucketName)) {
            return false;
        }

        return $bucketName;
    }

    public function validateCredentials()
    {
        if (!$this->getRegion() || !$this->getAccessKeyId() || !$this->getSecretAccessKey() || !$this->getBucketName()) {
            return false;
        }

        return true;
    }

}