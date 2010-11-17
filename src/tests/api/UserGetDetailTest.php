<?php

class UserGetDetail extends ApiTestBase {
		public function assertExpectedFields($res) {
			$this->assertEquals(1, count($res), 'Only one matching user should be returned');

			foreach($res as $user) {
				$this->assertType(PHPUnit_Framework_Constraint_IsType::TYPE_OBJECT, $user);
				$this->assertType(PHPUnit_Framework_Constraint_IsType::TYPE_STRING, $user->username, "User name for user " . $user->ID . " should be a string");
				$this->assertType(PHPUnit_Framework_Constraint_IsType::TYPE_STRING, $user->full_name);
				$this->assertTrue(is_numeric((string)$user->ID));
				$this->assertTrue(is_numeric((string)$user->last_login));
			}
		}

		public function testGetDetailByUsernameJSON() {
			$response = self::makeApiRequest('user', 'getdetail', array('uid'=>'johndoe'), 'json');

			$res = $this->decode_response($response, 'json');
			$this->assertTrue( $res !== null, "Could not decode JSON response");
			$this->assertExpectedFields($res);
		}

		public function testGetDetailByUsernameXML() {
			$response = self::makeApiRequest('user', 'getdetail', array('uid'=>'johndoe'), 'xml');

			$res = $this->decode_response($response, 'xml');
			$this->assertTrue( $res !== null, "Could not decode XML response");
			$this->assertExpectedFields($res);
		}

		public function testGetDetailByUserIDXML() {
			$response = self::makeApiRequest('user', 'getdetail', array('uid'=>'1'), 'xml');

			$res = $this->decode_response($response, 'xml');
			$this->assertTrue( $res !== null, "Could not decode XML response");
			$this->assertExpectedFields($res);
		}

		public function testGetDetailByUserIDJSON() {
			$response = self::makeApiRequest('user', 'getdetail', array('uid'=>'1'), 'json');

			$res = $this->decode_response($response, 'json');
			$this->assertTrue( $res !== null, "Could not decode JSON response");
			$this->assertExpectedFields($res);
		}

}
