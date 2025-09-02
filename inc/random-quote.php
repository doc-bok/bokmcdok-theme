<?php

/**
 * Random quote shortcode
 */
function random_quote() {
	$quotes = [
		'Worrying is a waste of imagination.',
		'It never gets easy, but it gets easier.',
		'You gotta have a little sadness once in a while so you know when the good times come.',
		'You are the inspiration the world needs.',
		'Fuck the job. I love the Verve.',
		'What if it turns out way better than you could have imagined?',
		'We will always be back then.',
		'Would you tell them to stop coming to therapy because what they should really be doing is completely changing the way our society is structured?',
		'Good ideas have no borders.',
		'<p style="color:#00f;background:#FFFF00;text-align:center;margin:0 25%;padding: 0.5em 1em;font-family:cursive;letter-spacing: 0.25em;font-size: 1em;rotate:3deg;">BELIEVE</p>',
		'You will never forgive yourself. Accept it. You hurt others, many others, that cannot be undone. You will never find personal retribution, but your life does not have to end. That which is right, just and true can still prevail. If you do not fight for what you believe in all may be lost for everyone else. But do not fight for yourself, fight for others, others that may be saved through your effort. That is the least you can do.',
		'I know. It’s all wrong. By rights we shouldn’t even be here. But we are. It’s like in the great stories. The ones that really mattered. Full of darkness and danger they were, and sometimes you didn’t want to know the end. Because how could the end be happy. How could the world go back to the way it was when so much bad happened. But in the end, it’s only a passing thing, this shadow. Even darkness must pass. A new day will come. And when the sun shines it will shine out the clearer. Those were the stories that stayed with you. That meant something. Even if you were too small to understand why. But I think I do understand. I know now. Folk in those stories had lots of chances of turning back only they didn’t. Because they were holding on to something. That there’s some good in this world. And it’s worth fighting for.',
		'If you always put limits on everything you do, physical or anything else, it will spread into your work and into your life. There are no limits. There are only plateaus, and you must not stay there, you must go beyond them.',
		'I\'m a Traveller born and bred,<br />On the road until I\'m dead<br />If that means I\'ll be alone<br />Then loneliness shall be my home',
		'Venture Adventure.',
		'You have the privilege of believing what\'s best in people. Me, I happen to know there are some things in this world that don\'t deserve forgiveness.',
		'I always wondered what kind of person could do such a thing, but now that I see you, I think I understand. There\'s just *nothing* inside you, nothing at all. You\'re pathetic and sad and empty.',
		'As I was going up the stairs<br />I met a man that wasn\'t there<br />He wasn\'t there again today<br />I wish, I wish he\'d go away',
		'Inaction is a weapon of mass destruction.',
		'I am thee Iself<br />I am thee Allself<br />I am thee Godself<br />I am thee Noself',
		'Every day!',
		'A thing isn\'t beautiful because it lasts',
		'Roses come in a variety of colors<br />And violets are violet, not blue<br />I\'m trying to write a romantic poem<br />Because I really want to fuck you',
		'F*** society',
		'As I flutter in the breeze<br />I think of what my mind\'s eye sees<br />At night when I\'m an old wise-man<br />Contemplating the things I can.<br />Am I the one that dreams of he,<br />Or is he the one that dreams of me?',
		'<b>An Irish Poem</b><br />Pome<br /> - <i>Bok McDok</i>',
		'It\'s okay if the first step in saving the world is saving one person. It\'s okay if that person is you.',
		'Use your privilege to protect those who don\'t have the same protections as you.',
		'Do more than just exist.',
		'You shall treat the alien who resides with you no differently than the natives born among you; you shall love the alien as yourself; for you too were once aliens in the land of Egypt. I, the LORD, am your God.<br />- <i>Leviticus 19:34</i>',
		'Love is not control. Love is not giving up everything for someone to keep them happy so they won\'t abuse you. It\'s never your fault. Don\'t start believing your abuser(s). You deserve better.',
		'It is possible to commit no mistakes and still lose. That is not weakness, that is life.',
		'When the whole world is running toward a cliff, - he who is running in the opposite direction appears to have lost his mind.',
		'Everyone keeps telling me how my story is supposed to go. Nah, imma do my own thing…',
		'Erratus or bust',
		'The engine room is heavy, and the idle man is free from it.',
		'Whenever you\'re feeling lost it\'s best to find where you\'re needed most',
		'I did it, Grandma. I finally stood up for myself. I got real mean and I beat the shnot outta Dr. Oz. I can\'t lie, it felt kind of good. At first. But since then all I have is just... a kind of dark, empty feeling. Then I realized... that\'s how you must feel. All the time. Poor old Grandma. You know, I\'ve been getting lots of advice how to deal with you. Stand up to you, tell on you... But I kind of realize there\'s just people like you out there. All over the place. When you\'re a kid, things seem like they\'re gonna last forever. But they\'re not. Life changes. Why you won\'t always be around. Someday you\'re gonna die. Someday pretty soon. And when you\'re laying in that hospital bed, with tubes up your nose, and that little pan under your butt to pee in, well I\'ll come visit ya. I\'ll come just to show you that I\'m still alive and I\'m still happy. And you\'ll die. Being nothing but you. \'Night Grandma!',
		'Individual science fiction stories may seem as trivial as ever to the blinder critics and philosophers of today, but the core of science fiction -- its essence -- has become crucial to our salvation, if we are to be saved at all.',
		'If anything, if anything at all is to come from this trial and from my statement on behalf of those I love, let it be that the world takes notice of the evil that can happen when people do nothing. And let it be that the world decides that doing nothing is not an option.',
		'Love yourself like your life depends on it.',
		'Never give up – keep going',
		'You\'re right. I hate people. I\'m scared of them. I\'ve been scared of them practically my whole life. People I loved-- people I trusted-- have done their absolute worst to me. And for a long time, that\'s all I ever knew. So, yeah, I called my group fsociety, because you know what? Fuck society. Society deserves to be hated for everything you said they did and more. Fuck every last one of them for what we\'ve all been through. But then there are some people out there... And it doesn\'t happen a lot. It\'s rare. But they refuse to let you hate them. In fact, they care about you in spite of it. And the really special ones, they\'re relentless at it. Doesn\'t matter what you do to them. They take it and care about you anyway. They don\'t abandon you, no matter how many reasons you give them. No matter how much you\'re practically begging them to leave. And you wanna know why? Because they feel something for me that I can\'t. They love me. And for all the pain I\'ve been through, that heals me. Maybe not instantly. Maybe not even for a long time, but it heals. And, yeah, there are setbacks. We do fucked up things to each other. And we hurt each other, and it gets messy, but that\'s just us, in any world you\'re in. And, yeah, you\'re right. We\'re all told we don\'t stand a chance, and yet we stand. We break, but we keep going, and that is not a flaw. That\'s what makes us. So, no, I will not give up on this world. And if you can\'t see why, then I speak for everyone when I say, fuck you!',
		'The employees that broke into the Treasury department with Elon Musk: Akash Bobba, Edward Coristine, Luke Farritor, Gautier Cole Killian, Gavin Kliger, and Ethan Shaotran',
		'Slava Ukraini',
		'We all become stories in the end.'
	];

	$quote = $quotes[array_rand($quotes)];

	return apply_filters('bok_random_quote', $quote);
}

function random_quote_shortcode(): string {
	return '<section id="block-random" class="widget widget_block">
		<blockquote class="wp-block-quote has-text-color has-small-font-size" style="color:#0088ff">
			<p>' . wp_kses_post(random_quote()) . '</p>
		</blockquote>
	</section>';
}

add_shortcode('random_quote', 'random_quote_shortcode');