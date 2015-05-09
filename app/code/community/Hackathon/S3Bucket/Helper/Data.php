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
     * Returns API endpoint based on region and bucket name
     *
     * @return bool|string
     */
    public function getEndpointUrl()
    {
        $awsRegion = Mage::getStoreConfig(self::XML_PATH_AWS_REGION);
        $bucket = Mage::getStoreConfig(self::XML_PATH_S3_BUCKET);

        if (empty($awsRegion) || empty($bucket)) {
            return false;
        }

        return sprintf('https://s3-%s.amazonaws.com/%s', $awsRegion, $bucket);
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

        return $awsAccessKey;
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

        return $awsSecretKey;
    }

}