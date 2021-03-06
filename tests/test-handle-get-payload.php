<?php

class HandleGetPayloadTest extends WP_Ajax_UnitTestCase {
  function test_get_payload() {
    update_option('webpush_payload', array(
      'test' => 'Marco',
    ));

    try {
      $this->_handleAjax('nopriv_webpush_get_payload');
      $this->assertTrue(false);
    } catch (WPAjaxDieContinueException $e) {
      $this->assertTrue(true);
    }

    $this->assertEquals('{"test":"Marco"}', $this->_last_response);
  }

  function test_get_payload_priv() {
    update_option('webpush_payload', array(
      'test' => 'Marco',
    ));

    try {
      $this->_handleAjax('webpush_get_payload');
      $this->assertTrue(false);
    } catch (WPAjaxDieContinueException $e) {
      $this->assertTrue(true);
    }

    $this->assertEquals('{"test":"Marco"}', $this->_last_response);
  }

  function test_get_payload_unicode_chars() {
    update_option('webpush_payload', array(
      'test' => 'Marco’s Test',
    ));

    try {
      $this->_handleAjax('nopriv_webpush_get_payload');
      $this->assertTrue(false);
    } catch (WPAjaxDieContinueException $e) {
      $this->assertTrue(true);
    }

    $this->assertEquals('{"test":"Marco\u2019s Test"}', $this->_last_response);
  }
}

?>
