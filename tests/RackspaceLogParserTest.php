<?php

namespace SkylerKatz\RackspaceLogParser\Tests;

use PHPUnit\Framework\TestCase;
use SkylerKatz\RackspaceLogParser\RackspaceLogParser;

class RackspaceLogParserTest extends TestCase
{
    /** @test */
    public function it_can_parse_a_log_file()
    {
        $path = __DIR__.'/stubs/cloudfiles.log.stub';

        $parser = new RackspaceLogParser($path);
        $result = $parser->parse();
        $this->assertCount(5, $result);

        $this->assertEquals('173.203.44.122 - - [15/07/2014:20:52:25 +0000] "GET /5142b6e5e57f760d7ff4-c591437fc634f2a98934b7738b8b8571.r93.cf1.rackcdn.com/image1.png HTTP/1.1" 304 277 "http://www.rackspace.com/" "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0. 50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E; MS-RTC LM 8; Microsoft Outlook 14.0. 7109; ms-office; MSOffice 14)"', $result[0]->raw);
        $this->assertEquals('173.203.44.122', $result[0]->clientIp);
        $this->assertEquals('GET', $result[0]->method);
        $this->assertEquals('/5142b6e5e57f760d7ff4-c591437fc634f2a98934b7738b8b8571.r93.cf1.rackcdn.com/image1.png', $result[0]->request);
        $this->assertEquals('HTTP/1.1', $result[0]->httpVersion);
        $this->assertEquals('304', $result[0]->returnCode);
        $this->assertEquals('277', $result[0]->bytesSent);
        $this->assertEquals('http://www.rackspace.com/', $result[0]->referrer);
        $this->assertEquals('Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.1; WOW64; Trident/5.0; SLCC2; .NET CLR 2.0. 50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; InfoPath.3; .NET4.0C; .NET4.0E; MS-RTC LM 8; Microsoft Outlook 14.0. 7109; ms-office; MSOffice 14)"', $result[0]->userAgent);
    }
}
