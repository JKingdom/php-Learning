<?php
require_once 'second.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * MyValidator test case.
 */
class SecondDayMyValidatorTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var MyValidator
     */
    private $MyValidator;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // TODO Auto-generated SecondDayMyValidatorTest::setUp()
        $value = 1;
        $this->MyValidator = new MyValidator($value/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated SecondDayMyValidatorTest::tearDown()
        $this->MyValidator = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests MyValidator->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated SecondDayMyValidatorTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");
        
        $this->MyValidator->__construct(/* parameters */);
    }

    /**
     * Tests MyValidator->number()
     */
    public function testNumber()
    {
        // 该单元测试用例采用等价类方式测试，黑盒测试
        // 分类依据为 正数，负数， 正常范围数字，非正常范围数字，字符括起数字，字符，字符数字交叉
        // 函数返回值为1为数字，返回0为非数字
        // unit1 input 1 result 1 
        $this->MyValidator->setValue(1);
        $this->assertEquals(1, $this->MyValidator->number());
        
        // unit2 input 134567234562  result 1
        $this->MyValidator->setValue(134567234562);
        $this->assertEquals(1, $this->MyValidator->number());
        
        // unit3 input 23456789234567834567834567893456789 result 0  error 超出正常数范畴，会被转变为科学记数法，不认为为有效数字
        $this->MyValidator->setValue(23456789234567834567834567893456789);
        $this->assertEquals(0, $this->MyValidator->number());
        
        // unit4 input -1 result 1
        $this->MyValidator->setValue(-1);
        $this->assertEquals(1, $this->MyValidator->number());
        
        // unit5 input -134567234562  result 1
        $this->MyValidator->setValue(-134567234562);
        $this->assertEquals(1, $this->MyValidator->number());
        
        // unit6 input 23456789234567834567834567893456789  result 0 error 理由同unit3
        $this->MyValidator->setValue(-23456789234567834567834567893456789);
        $this->assertEquals(0, $this->MyValidator->number());
        
        // unit7 input "123" result 1  字符括起数字
        $this->MyValidator->setValue("123");
        $this->assertEquals(1, $this->MyValidator->number());
        
        // unit8 input "abc" result 0 字符
        $this->MyValidator->setValue("abc");
        $this->assertEquals(0, $this->MyValidator->number());
        
        // unit9 input abc result 0 字符
        $this->MyValidator->setValue(abc);
        $this->assertEquals(0, $this->MyValidator->number());
        
        // unit9 input abc result 0 字符数字交叉
        $this->MyValidator->setValue("123bdsa1");
        $this->assertEquals(0, $this->MyValidator->number());
    }

    /**
     * Tests MyValidator->mobile()
     */
    public function testMobile()
    {
        //该单元测试用例采用等价类的方式测试，黑盒测试
        //划分依据  正常 (电信 移动 联通)号码 ， 加地址位置正常号码， 非地理位置正常号码，  非号码但是11位数字， 非11位数字
        // 非号码11位数字+地理位置号, 非地理位置非号码11位数字，非11位数字非地理位置，
        // 字符， 字符数字混合， 数字空格混合
        
        // unit1 正常-电信
        $this->MyValidator->setValue("13312341234");
        $this->assertEquals(1, $this->MyValidator->mobile());
        
        // unit2 正常-移动
        $this->MyValidator->setValue("15112341234");
        $this->assertEquals(1, $this->MyValidator->mobile());
        
        // unit3 正常-联通
        $this->MyValidator->setValue("13212341234");
        $this->assertEquals(1, $this->MyValidator->mobile());
        
        // unit4 +地理位置
        $this->MyValidator->setValue("8613212341234");
        $this->assertEquals(1, $this->MyValidator->mobile());
        
        // unit4.1 +地理位置
        $this->MyValidator->setValue("86+13212341234");
        $this->assertEquals(1, $this->MyValidator->mobile());
        
        // unit5 +非地理位置
        $this->MyValidator->setValue("86113212341234");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit6 + 非号码但是11位
        $this->MyValidator->setValue("11111111111");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit7 + 非11位
        $this->MyValidator->setValue("1331255273");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit8 + 非号码但是11位+地理位置
        $this->MyValidator->setValue("8611111111111");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit9 + 非号码非地理位置
        $this->MyValidator->setValue("8511111111111");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit10 + 非11位非地理位置
        $this->MyValidator->setValue("851111111");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit11 + 字符
        $this->MyValidator->setValue("asdfghjkutr");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit12 + 字符数字
        $this->MyValidator->setValue("151fghjkutr");
        $this->assertEquals(0, $this->MyValidator->mobile());
        
        // unit13 + 数字空格
        $this->MyValidator->setValue("1518731 035");
        $this->assertEquals(0, $this->MyValidator->mobile());
    }

    /**
     * Tests MyValidator->telephone()
     */
    public function testTelephone()
    {
        //该单元测试用例采用等价类的方式测试，黑盒测试
        //划分依据  1开头，非1开头 7位 8位 非7,8进行组合 + 字符 + 数字字符混合
        // 
        //unit1  1开头 7位
        $this->MyValidator->setValue("1111111");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit2  1开头 8位
        $this->MyValidator->setValue("10000100");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit3  1开头 非78位
        $this->MyValidator->setValue("10000");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit4  非1开头 7位
        $this->MyValidator->setValue("6553645");
        $this->assertEquals(1, $this->MyValidator->telephone());
        //unit5  非1开头 8位
        $this->MyValidator->setValue("65536445");
        $this->assertEquals(1, $this->MyValidator->telephone());
        //unit6  非1开头 非78位
        $this->MyValidator->setValue("65536445000");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit7  字符
        $this->MyValidator->setValue("bfdhsjkf");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit8  字符数字混合
        $this->MyValidator->setValue("6553ffs5");
        $this->assertEquals(0, $this->MyValidator->telephone());
    }

    /**
     * Tests MyValidator->email()
     */
    public function testEmail()
    {
        //该单元测试用例采用等价类的方式测试，黑盒测试
        // 以.开头，含有特殊字符，user超出长度，domin超出长度
        // 正常
        $this->MyValidator->setValue("renjiangang@baixing.com");
        $this->assertEquals(1, $this->MyValidator->email());
        //unit1  以.开头
        $this->MyValidator->setValue(".renjiangang@baixing.com");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit2  含有特殊字符
        $this->MyValidator->setValue("re$%^njiangang@baixing.com");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit3  user超出长度
        $this->MyValidator->setValue("renjiangangddfghhhhgfhfghfhdfhgdfhdfghdfhgdfhfdhdfhdfhdfhgdfghdhgdh@baixing.com");
        $this->assertEquals(0, $this->MyValidator->telephone());
        //unit4  domin超出长度
        $this->MyValidator->setValue("renjiangang@bai.fdsfs.fdfsfsdfsdfsdfsdfsdfsdfsdfsdfsfsdfsfs.fdsfsdfsdfsd.fsdfsdfds
            .fsdfsdfs
            sfsd.fdsfs.fsdfs.fdsfs.fdsfsd.fsfsdf.fdsf.fsdfsf
            .fssf.fssf.fssf.fssf.fssf.fssf.fssf.fssf.fssf.fssf.fssf.fsxing.com");
        $this->assertEquals(0, $this->MyValidator->telephone());
        
    }
}

