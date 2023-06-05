<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/firestore/v1/firestore.proto

namespace Google\Cloud\Firestore\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The response for
 * [Firestore.ListDocuments][google.firestore.v1.Firestore.ListDocuments].
 *
 * Generated from protobuf message <code>google.firestore.v1.ListDocumentsResponse</code>
 */
class ListDocumentsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * The Documents found.
     *
     * Generated from protobuf field <code>repeated .google.firestore.v1.Document documents = 1;</code>
     */
    private $documents;
    /**
     * A token to retrieve the next page of documents.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     */
    private $next_page_token = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type array<\Google\Cloud\Firestore\V1\Document>|\Google\Protobuf\Internal\RepeatedField $documents
     *           The Documents found.
     *     @type string $next_page_token
     *           A token to retrieve the next page of documents.
     *           If this field is omitted, there are no subsequent pages.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Firestore\V1\Firestore::initOnce();
        parent::__construct($data);
    }

    /**
     * The Documents found.
     *
     * Generated from protobuf field <code>repeated .google.firestore.v1.Document documents = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * The Documents found.
     *
     * Generated from protobuf field <code>repeated .google.firestore.v1.Document documents = 1;</code>
     * @param array<\Google\Cloud\Firestore\V1\Document>|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setDocuments($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Google\Cloud\Firestore\V1\Document::class);
        $this->documents = $arr;

        return $this;
    }

    /**
     * A token to retrieve the next page of documents.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @return string
     */
    public function getNextPageToken()
    {
        return $this->next_page_token;
    }

    /**
     * A token to retrieve the next page of documents.
     * If this field is omitted, there are no subsequent pages.
     *
     * Generated from protobuf field <code>string next_page_token = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setNextPageToken($var)
    {
        GPBUtil::checkString($var, True);
        $this->next_page_token = $var;

        return $this;
    }

}

