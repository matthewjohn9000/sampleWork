<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<?php
$bronzeQuiz = (array(

	"questions" => array(
	0 =>array(
		"question" => "What are the benefits of riding a bike?",
		"image" => "images/q1.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Biking is a good exercise. It helps your body to be healthy.",
					"hint" => "You're right that biking helps your body be healthy. But, it also helps your brain, and it's fun! The correct answer is - All of these are benefits of bicycling."
			),
			1 => array(
				"option" => "Biking is good for your brain and mood.",
					"hint" => "wYou're right that biking helps your brain. But, it also helps your body be healthy, and it's fun! The correct answer is - All of these are benefits of bicycling."
			),
			2 => array(
				"option" => "Biking is fun!",
					"hint" => "You're right that biking is fun. But, it's also helps your body and brain. The correct answer is - All of these are benefits of bicycling."
			),
			3 => array(
				"option" => "All of these are benefits of biking.",
					"hint" => "Correct!"
			)
		),
		"answer" => 3
	),
	1 =>array(
		"question" => "When kids on bikes collide with cars, is it usually the car driver or the bike rider who made the mistake?",
		"image" => "images/q2.svg",
		"options" =>array(
			0 => array(
			  	"option" => "The car driver made the mistake, most of the time.",
					"hint" => "Incorrect.  Most of the time, young bike riders make the mistake. One mistake is riding out into the street when a car is coming. Another is not looking behind for cars, before moving or turning left. You can have fun and be safe if you learn the rules and follow them."
			),
			1 => array(
				"option" => "The bike rider made the mistake, most of the time.",
					"hint" => "Correct! Most of the time, young bike riders make the mistake. One mistake is riding out into the street when a car is coming. Another is not looking behind for cars, before moving or turning left. You can have fun and be safe if you learn the rules and follow them."
			)

		),
		"answer" => 1
	),
	2 =>array(
		"question" => "This sign tells car drivers to:  Stop. Look LEFT, RIGHT, LEFT. Go when no other cars are coming. What does it tell bike riders?",
		"image" => "images/q3.svg",
		"options" =>array(
			0 => array(
			  	"option" => "The same thing. Stop. Look LEFT, RIGHT, LEFT. Go when no cars are coming.",
					"hint" => "Correct! Most of the time, young bike riders make the mistake. One mistake is riding out into the street when a car is coming. Another is not looking behind for cars, before moving or turning left. You can have fun and be safe if you learn the rules and follow them."
			),
			1 => array(
				"option" => "Keep going, but slow down. Bike riders have different rules than cars.",
					"hint" => "Wrong, that's dangerous! Bike riders must follow the same rules and signs that car drivers do. That way, everyone is safer. The correct answer is - The same thing. Stop. Look LEFT, RIGHT, LEFT. Go when no cars are coming."
			),
			2 => array(
				"option" => "Keep going fast. Bike riders have different rules than cars.",
					"hint" => "Wrong, that's dangerous! Bike riders must follow the same rules and signs that car drivers do. That way, everyone is safer. The correct answer is - The same thing. Stop. Look LEFT, RIGHT, LEFT. Go when no cars are coming."
		)
		),
		"answer" => 0
	),
	3 =>array(
		"question" => "Which is the correct side of the road to ride your bike?",
		"image" => "images/q4.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Right side (the same side as cars)",
					"hint" => "Correct! The law says that bike riders must ride on the right side, because that is safer. Most car/bike safety problems are at intersections. There, car drivers look for other cars (and bikes) coming on the right side of the road. Most car drivers do not look for anyone coming on the left side of the road. When you bike on the right side, you will always be riding on the side where car drivers are looking - that makes you safer."
			),
			1 => array(
				"option" => "Left side (the other side than cars)",
					"hint" => "Incorrect. You may think that it is safer to bike on the left side, so you can see cars coming better. But, the bigger safety problem is at intersections. There, car drivers look for other cars (and bikes) coming on the right side of the road. Most car drivers do not look for anyone coming on the left side of the road. When you bike on the right side, you will always be riding on the side where car drivers are looking - that makes you safer."
			),
			2 => array(
				"option" => "Bikes are not allowed on the road. Bikes must ride on sidewalks.",
					"hint" => "Incorrect. Bikes are allowed on roads, just like cars. The law says that bike riders on the road must ride on the right side, because that is safer. Most car/bike safety problems are at intersections. There, car drivers look for other cars (and bikes) coming on the right side of the road.  Most car drivers do not look for anyone coming on the left side of the road. When you bike on the right side, you will always be riding on the side where car drivers are looking."
			),
		),
		"answer" => 0
	),
	4 =>array(
		"question" => "What does this bike rider need to watch out for?",
		"image" => "images/q5.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Car driver 1 might turn right without stopping for the bike rider, when the bike rider is already in the crosswalk.",
					"hint" => "Yes, that is a driver mistake that the bike rider must watch out for. But, so are the other choices, too. The answer is - The bike rider must watch out for all three of these situations."
			),
			1 => array(
				"option" => "Car driver 2 might not see the bike rider, when the driver turns left.",
					"hint" => "Yes, that is a driver mistake that the bike rider must watch out for. But, so are the other choices, too. The answer is - The bike rider must watch out for all three of these situations."
			),
			2 => array(
				"option" => "Car driver 3 might not stop at the stop line, or does not look in the bike rider's direction, when the driver turns right.",
					"hint" => "Yes, that is a driver mistake that the bike rider must watch out for. But, so are the other choices, too. The answer is - The bike rider must watch out for all three of these situations."
			),
			3 => array(
				"option" => "The bike rider must watch out for all three of these situations.",
					"hint" => "Correct! When you bike in this direction on a sidewalk, it's harder for car drivers to see you when they turn at intersections. You are not where drivers are looking when the drivers are deciding when to make their turn. Also, drivers make mistakes by not looking both ways. So, you must watch carefully and be ready to stop."
			)
		),
		"answer" => 3
	),
	5 =>array(
		"question" => "When you get to the end of a driveway, what should you do?",
		"image" => "images/q6.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Stop and look both ways for cars before riding into the street.",
					"hint" => "Correct! You must stop, then look LEFT, RIGHT, LEFT for cars. If no cars are coming, then go. But if a car's coming, wait for it to pass. Then look LEFT, RIGHT, LEFT again."
			),
			1 => array(
				"option" => "Cars are supposed to stop for bikes. So, you can ride fast into the street.",
					"hint" => "WRONG! This is very dangerous.  You must stop, then look LEFT, RIGHT, LEFT for cars. If no cars are coming, then go. But if a car's coming, wait for it to pass. Then look LEFT, RIGHT, LEFT again."
			)
		),
		"answer" => 0
	),
	6 =>array(
		"question" => "True or False. When you turn your head to look for cars behind you, it is important that your bike keeps going straight without turning or wobbling.",
		"image" => "images/q7.svg",
		"options" =>array(
			0 => array(
			  	"option" => "TRUE",
					"hint" => "Correct! Learn how to keep your bike steady and straight when you look back. Here's how to practice:  Ride along a straight line. Have a friend stand behind you, holding up one or two arms. Look back for a second and see if you can tell how many arms they're holding up. If it's hard to turn your head, try putting your hand on your leg (like the bottom left image)."
			),
			1 => array(
				"option" => "FALSE",
					"hint" => "Incorrect. Learn how to keep your bike steady and straight when you look back. Here's how to practice:   Ride along a straight line. Have a friend stand behind you, holding up one or two arms. Look back for a second and see if you can tell how many arms they're holding up. If it's hard to turn your head, try putting your hand on your leg (like the bottom left image)."
			)
		),
		"answer" => 0
	),
	7 =>array(
		"question" => "If you are riding your bike on the road, when should you look for cars behind you?",
		"image" => "images/q8.svg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Before you ride around something in your way. That could be a pothole, drain grate, parked car, a slower bicycle, or something else.",
					"hint" => "Yes, you should look back before you ride around something. But you should ALSO look back before you turn left. The correct answer is - Both (1) and (2) are correct."
			),
			1 => array(
				"option" => "(2) - Before you turn left.",
					"hint" => "Yes, you should look back before you turn left. But you should also look back before you ride around something. The correct answer is - Both (1) and (2) are correct."
			),
			2 => array(
			  	"option" => "Both (1) and (2) are correct.",
					"hint" => "Correct! It is also good to look back once in a while when you're just riding straight. That way, you will know when cars are coming."
			),
			3 => array(
				"option" => "Both (1) and (2) are NOT correct.",
					"hint" => "Incorrect. You should look back before you ride around something and before you turn left. The correct answer is - Both (1) and (2) are correct."
			),

		),
		"answer" => 2
	),
	8 =>array(
		"question" => "When you want to turn left, which of these ways are allowed?",
		"image" => "images/q9.svg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Look back over your shoulder for cars coming behind you. When no cars are coming, move to the left part of your lane. Point your arm in the direction you're turning. Look for cars in front of you and also look LEFT-RIGHT-LEFT for cars. When no cars are coming, turn left.",
					"hint" => "You are allowed to turn like this, like a car turns left. But, you are also allowed to turn like (2), which might be easier if there are cars coming behind you. The correct answer is - Both (1) and (2) are allowed."
			),
			1 => array(
				"option" => "(2)  - When no cars are coming, ride or walk your bike across the street. Stop just before you get to the curb on the other side. Turn your bike so you are facing where you want to go. When no cars are coming, cross the other street and ride on.",
					"hint" => "You are allowed to turn like this. (2) might be easier if there are cars coming behind you. But, you are also allowed to turn like (1), like a car turns left. The correct answer is - Both (1) and (2) are allowed."
			),
			2 => array(
			  	"option" => "Both (1) and (2) are correct.",
					"hint" => "Correct! Both of these turns are allowed. If there are cars coming behind you, (2) might be easier for you."
			),
			3 => array(
				"option" => "Both (1) and (2) are NOT correct.",
					"hint" => "Incorrect. Both (1) and (2) are allowed. If there are cars coming behind you, (2) might be easier for you."
			),

		),
		"answer" => 2
	),
	9 =>array(
		"question" => "Car drivers must take turns using these rules:<ul>A) First to stop - the first person at the intersection goes first.</ul><ul>B) Right goes first. If two cars get to the intersection at the same time, the person on the right goes first.</ul><ul>C) Straight goes first. When two cars are across from each other, and one is going straight and the other is turning left, the one that is going straight goes first.</ul>What happens when there are both cars and bikes? Do the same rules apply?",
		"image" => "images/q10.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Yes, same rules.",
					"hint" => "Correct! Bike riders must follow the same rules as car drivers.  That includes taking turns at an intersection."
			),
			1 => array(
				"option" => "No, different rules.",
					"hint" => "Incorrect. Bike riders must follow the same rules as car drivers.  That includes taking turns at an intersection."
			)
		),
		"answer" => 0
	),
	10 =>array(
		"question" => "Bike helmets protect your brain, in case you fall when riding your bike. And your brain is worth it!  Which helmet fit is correct - level or tilted?",
		"image" => "images/q11.svg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - tilted on the head",
					"hint" => "Incorrect. The helmet should fit level on the head, so it can protect your forehead. You should be able to look up and see the bottom of your helmet. If your helmet does not fit this way, the straps need to be fixed. Ask an adult if you need help."
			),
			1 => array(
				"option" => "(2) - level on the head",
					"hint" => "Correct! The helmet should fit level on the head, so it can protect your forehead. You should be able to look up and see the bottom of your helmet. If your helmet does not fit this way, the straps need to be fixed. Ask an adult if you need help."
			),

		),
		"answer" => 1
	),
	11 =>array(
		"question" => "Helmet straps need to be snapped together and adjusted correctly to keep the helmet on your head during a fall. Which picture shows straps that are correct?",
		"image" => "images/q12.svg",
		"options" =>array(
			0 => array(
			  	"option" => "Illustration (1)",
					"hint" => "Incorrect. The straps should form a \"Y\" just below your ears. The \"Y\" is too low in (1). Also, the straps should be snug against your chin, but not too tight. You should be able to fit one finger between the straps and your chin, and you should feel the helmet tug on the top of your head when you open your mouth wide. Ask an adult if you need help setting your straps this way."
			),
			1 => array(
				"option" => "Illustration (2)",
					"hint" => "Correct! The straps should form a \"Y\" just below your ears, like (2). Also, the straps should be snug against your chin, but not too tight. You should be able to fit one finger between the straps and your chin, and you should feel the helmet tug on the top of your head when you open your mouth wide. Ask an adult if you need help setting your straps this way."
			),

		),
		"answer" => 1
	),
	
//close question array
)
//close bronze quiz
));
	
$silverQuiz = (array(
	"questions" => array(
	0 =>array(
		"question" => "When a car backs up in a driveway, the driver may forget to check sidewalks for kids riding bikes.  Clues that a car may start backing up include:",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "You can see a driver in the car.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "White tail lights are on..",
					"hint" => "wrong"
			),
			2 => array(
				"option" => "Engine noise.",
					"hint" => "wrong"
			),
			3 => array(
				"option" => "All of these choices are correct.",
					"hint" => "right"
			)
		),
		"answer" => 3
	),
	1 =>array(
		"question" => "You should begin riding on the street.",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "When you can bike fast enough, like 20 miles per hour.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "At age 10.",
					"hint" => "wrong"
			),
			2 => array(
			  	"option" => "When your parent says it is okay.",
					"hint" => "right"
			),
			3 => array(
				"option" => "Bicycles are not allowed on the street.",
					"hint" => "wrong"
			)
		),
		"answer" => 2
	),
	2 =>array(
		"question" => "There are some parked cars on this road.  Is it better to weave around the parked cars (1), or to keep a straight line (2)?",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Weave around parked cars",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "(2) - Keep a straight line",
					"hint" => "right"
			),

		),
		"answer" => 1
	),
	3 =>array(
		"question" => "Which picture shows the better way to ride around a car parked in the road?",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Closer to the car",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "(2) Farther from the car",
					"hint" => "right"
			)
		),
		"answer" => 1
	),
	4 =>array(
		"question" => "Your friend is biking ahead of you.  She checks for cars before crossing a street.  Do you need to look for cars, too?",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "YES",
					"hint" => "right"
			),
			1 => array(
				"option" => "NO",
					"hint" => "wrong"
			),

		),
		"answer" => 0
	),
	5 =>array(
		"question" => "Pic the correct answer:",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "Two people are allowed to ride on a regular, one-person bike.  The second person can stand in the back by the wheel, or sit on the handlebars.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "Bikes should not be used to carry more people than it was designed for.  Only one person should ride on a one-person bike.",
					"hint" => "right"
			)
		),
		"answer" => 1
	),
	6 =>array(
		"question" => "Pick the correct answer:",
		"image" => "img/silverQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "Bike riders are not allowed to ride at night.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "If you ride your bike at night and you can see ahead of you, then you do not need lights or reflectors.",
					"hint" => "wrong"
			),
			2 => array(
			  	"option" => "If you ride a bike at night, you must have a bright white light in front and a red reflector in the back.  A blinking red light in back is also a good idea.",
					"hint" => "right"
			)
		),
		"answer" => 3
	),
	
	
//close question array	
)
//close silver quiz
));
	
$goldQuiz = (array(
	"questions" => array(
	0 =>array(
		"question" => "Look at the bike's back tire in these pictures.  Which show the correct amount of air in the tire?",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - The pictures on top",
					"hint" => "right"
			),
			1 => array(
				"option" => "(2) - The pictures on bottom",
					"hint" => "wrong"
			)
		),
		"answer" => 0
	),
	1 =>array(
		"question" => "It is easier and safer to ride a bike that is the right size and fit for you.  The seat can be moved up or down.  However, most bike riders do not have their seat at the right level.  Which picture shows the correct seat level?",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Bike rider's knee is bent a lot, when the pedal is at its low point",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "(2) - Bike rider's knee is bent just a little bit, when the pedal is at its low point",
					"hint" => "right"
			),
			2 => array(
				"option" => "(3) - Bike rider's knee is completely straight, when the pedal is at its low point",
					"hint" => "wrong"
			)
		),
		"answer" => 1
	),
	2 =>array(
		"question" => " When riding on a sidewalk or a trail, you see a person walking up ahead.  You should:",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "Pass on the grass.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "Let the person you know you wouuld like to pass, and wait for them to move.",
					"hint" => "right"
			),
			2 => array(
				"option" => "You should never ride on a sidewalk.",
					"hint" => "wrong"
			)
		),
		"answer" => 1
	),
	3 =>array(
		"question" => "It's important to let car drivers know what you're doing.  Which drawing shows the correct way to signal that you are turning right??",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "Either drawing (1) or drawing (5)",
					"hint" => "right"
			),
			1 => array(
				"option" => "Drawing (2)",
					"hint" => "wrong"
			),
			2 => array(
				"option" => "Drawing (3)",
					"hint" => "wrong"
			),
			3 => array(
				"option" => "Drawing (4)",
					"hint" => "wrong"
			)
		),
		"answer" => 0
	),
	4 =>array(
		"question" => "Which drawing shows the correct way to signal that you are turning left?",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "Either drawing (1) or drawing (5)",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "Drawing (2)",
					"hint" => "right"
			),
			2 => array(
				"option" => "Drawing (3)",
					"hint" => "wrong"
			),
			3 => array(
				"option" => "Drawing (4)",
					"hint" => "wrong"
			)
		),
		"answer" => 1
	),
	5 =>array(
		"question" => "Which drawing shows the correct way to signal that you are stopping?",
		"image" => "img/goldQ1.jpg",
		"options" =>array(
			0 => array(
			  	"option" => "(1) - Before you ride around something in your way.  That could be a pothole, drain grate, parked car, a slower bicycle, or something else.",
					"hint" => "wrong"
			),
			1 => array(
				"option" => "(2) - Before you turn left.",
					"hint" => "wrong"
			),
			2 => array(
			  	"option" => "Both (1) and (2) are correct.",
					"hint" => "right"
			),
			3 => array(
				"option" => "Both (1) and (2) are NOT correct.",
					"hint" => "wrong"
			)

		),
		"answer" => 2
	),
	
	
//close question array	
)
//close gold quiz
));
	
	

?>
<body>
</body>
</html>