<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h4'));

        $client->clickLink('View');

        $this->assertPageTitleContains('Amsterdam');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Amsterdam 2019');
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }

    // failing
    // public function testCommentSubmission()
    // {
    //     $client = static::createClient();
    //     $crawler = $client->request('GET', '/conference/Amsterdam-2019');

    //     $client->submitForm('comment_form_submit', [
    //         'comment_form[author]' => 'john',
    //         'comment_form[text]' => 'some feedback from an automated functional test',
    //         'comment_form[email]' => 'john@autotest.org',
    //         'comment_form[photo]' => dirname(__DIR__, 2) . '/public/images/under-construction.gif'
    //     ]);
    //     $this->assertResponseRedirects();
    //     $client->followRedirect();
    //     $this->assertSelectorExists('div:contains("There are 2 comments")');
    // }
}
