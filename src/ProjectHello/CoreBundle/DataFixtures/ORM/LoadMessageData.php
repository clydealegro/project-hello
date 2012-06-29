<?php

namespace ProjectHello\CoreBundle\DataFixtures\ORM;

use
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager,
    ProjectHello\CoreBundle\Entity\Message
;

/**
 * Fixture for loading message data.
 *
 * @author projecthello
 */
class LoadMessageData extends AbstractFixture implements
        OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // init data
        $data = array (
            array (
                'message'       => '"Hi Mon, Every code has its origin, more importantly programming is a journey thus moving on is part of it.. Goodluck in your new career pursuit.\"<br /><br />Web you around :D',
                'authorName'    => 'Farly & Czar',
            ),
            array (
                'message'       => 'hi mon!<br /><br /> &nbsp; &nbsp; &nbsp; Goodluck and best wishes!!!keep on rocking MONster!!!',
                'authorName'    => 'Ronald Ryan L. Vy',
            ),
            array (
                'message'       => "Hi Mon, <br /><br />You've been an awesome team mate. It has been my pleasure working with you. Keep up the good work and go for the gold! <br /><br /> Here's to your new job and to the love of your life :) Keep in touch ok? <br /><br /> P.S Paukya kmi iyo balay kun makadto kmi Cebu ha?",
                'authorName'    => 'Augustianne Laurenne L. Barreta',
            ),
            array (
                'message'       => "Thanks for the short-lived friendship,mon. Actually i'm secretly glad that you're going, this time i'll be the ONLY Green Room Queen. LOL.  Kidding aside, you're such a wonderful person. I wish you all the happiness and love in this world particularly in CEBU, you deserve it. Bon Voyage!",
                'authorName'    => 'Joy Amor Moreno',
            ),
            array (
                'message'       => '"Balik hit Sports Fest. Waray na daw kami hini MVP. We will miss you. :)"',
                'authorName'    => 'Jean',
            ),
            array (
                'message'       => "Kuya Mon, <br /><br /> &nbsp; &nbsp; &nbsp; GO FOR GOLD... FOLLOW YOUR HEART... hahaha. Blit Kuya, I know na bisan ka kumain, you'll always boom and prosper. You are so blessed with a good heart. Honestly, I feel bad and sad na you'll be leaving GAP. You're such a genuine person. Thank you for the friendship. You'll always be in my prayers. Take care and God bless you always.",
                'authorName'    => 'Desiree Lynn C. Blanco',
            ),
            array (
                'message'       => 'Salamat Mon!',
                'authorName'    => 'Naldz',
            ),
            array (
                'message'       => "Hey, Mon <br /> <br />Ahm they said your going to Cebu, and i would like to say good luck and have a great time in cebu its really a nice place...
                even thought expensive it lifestyle hehehe basta maupay it work no worries ingat and GOD bless!!!...Have a nice trip! <br /><br /> --^^---^^---^---^--^--^^---",
                'authorName'    => 'Eric Burabod',
            ),
            array (
                'message'       => 'Mon - my former crush haha! take care and God bless you always',
                'authorName'    => 'Vanessa',
            ),
            array (
                'message'       => "Mon, You are one of the nicest people I know. I wish you all the success not only in your career but also in your personal life. God bless in all of your endeavors.",
                'authorName'    => 'Chris',
            ),
            array (
                'message'       => "Monster, <br /><br /> Thanks ha tanan, <br /> Sorry ha tanan... <br /> Pag-opay nala, <br /> Kon kumain kman.",
                'authorName'    => 'Mercy',
            ),
            array (
                'message'       => "Kuya Mon, <br /><br /> &nbsp; &nbsp; &nbsp; Thank you ha tanan nga memories, laughter and kung anu-ano pa.. We'll miss you.. God bless!",
                'authorName'    => 'Neri',
            ),
            array (
                'message'       => "Boi goodluck sa imohang new endeavors and love life. Don't forget to keep in touch. We will miss you.",
                'authorName'    => 'Clyde',
            ),
            array (
                'message'       => 'Hi Mon, good luck, sure naman ak na maging successful ka ngadto kay maupay tim work ethics ngan technical skills pero ayaw pagduro duro, burubisita la ngadi kay ma one game kita, hahahaha....',
                'authorName'    => 'Noel',
            ),
        );
        
        // persist data
        $i = 0;
        foreach ($data as $d) {
            
            $message = new Message();
            $message->setMessage($d['message']);
            $message->setAuthorName($d['authorName']);
            $message->setCard($manager->merge($this->getReference('card0')));
            $message->setAuthor($manager->merge($this->getReference('user'
                    . $i ++)));
            
            $manager->persist($message);
            $manager->flush();
        }
    }
    
    // the order in which this fixture will be loaded
    public function getOrder()
    {
        return 4;
    }
}