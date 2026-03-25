<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            // Sports - Outdoor
            ['name' => 'Premier Football Cup', 'category' => 'Sports', 'sub_category' => 'Outdoor', 'fees' => 500.00, 'description' => '11v11 inter-college showdown. Team strategy and precision.'],
            ['name' => 'Athletics Main Event', 'category' => 'Sports', 'sub_category' => 'Outdoor', 'fees' => 0.00, 'description' => '100m, 200m, Relay, and Long Jump. Pure speed and power.'],
            ['name' => 'Javelin & Shotput', 'category' => 'Sports', 'sub_category' => 'Outdoor', 'fees' => 150.00, 'description' => 'Test your strength and technique in field events.'],
            ['name' => 'Cricket Championship', 'category' => 'Sports', 'sub_category' => 'Outdoor', 'fees' => 400.00, 'description' => 'T20 Format. Battle of the departments for the trophy.'],
            
            // Sports - Indoor
            ['name' => 'Badminton Smash', 'category' => 'Sports', 'sub_category' => 'Indoor', 'fees' => 200.00, 'description' => 'Singles and Doubles. High intensity court battle.'],
            ['name' => 'Table Tennis Pro', 'category' => 'Sports', 'sub_category' => 'Indoor', 'fees' => 100.00, 'description' => 'Fast reflexes, sharp spins. Fast-paced table action.'],
            ['name' => 'Chess Masters', 'category' => 'Sports', 'sub_category' => 'Indoor', 'fees' => 50.00, 'description' => 'Mental warfare. The ultimate test of strategy for the mind.'],
            ['name' => '3v3 Basketball', 'category' => 'Sports', 'sub_category' => 'Indoor', 'fees' => 300.00, 'description' => 'Fast-paced indoor madness. Street-style dominance.'],

            // Arts - Indoor
            ['name' => 'Natyam', 'category' => 'Arts', 'sub_category' => 'Indoor', 'fees' => 100.00, 'description' => 'Classical dance competition showcasing grace and rhythm.'],
            ['name' => 'Swaralaya', 'category' => 'Arts', 'sub_category' => 'Indoor', 'fees' => 50.00, 'description' => 'Vocal music competition across various genres.'],
            ['name' => 'Chithram', 'category' => 'Arts', 'sub_category' => 'Indoor', 'fees' => 30.00, 'description' => 'Live painting and sketching competition.'],
            ['name' => 'Drama', 'category' => 'Arts', 'sub_category' => 'Indoor', 'fees' => 200.00, 'description' => 'Theatrical performance celebrating the art of storytelling.'],

            // Arts - Outdoor
            ['name' => 'Carnival', 'category' => 'Arts', 'sub_category' => 'Outdoor', 'fees' => 0.00, 'description' => 'Mega cultural parade with music and costumes.'],
            ['name' => 'Street Battle', 'category' => 'Arts', 'sub_category' => 'Outdoor', 'fees' => 0.00, 'description' => 'Hip-hop and freestyle dance battles on the streets.'],
            ['name' => 'Open Stage', 'category' => 'Arts', 'sub_category' => 'Outdoor', 'fees' => 0.00, 'description' => 'Platform for impromptu performances and talent showcase.'],
            ['name' => 'Mural Live', 'category' => 'Arts', 'sub_category' => 'Outdoor', 'fees' => 0.00, 'description' => 'Large scale wall art and graffiti competition.'],
            // Algorithm - Featured Events
            ['name' => 'Valorant Pro League', 'category' => 'Algorithm', 'sub_category' => 'Gaming', 'fees' => 0.00, 'description' => 'The premier tactical shooter showdown. Elite strategy required.'],
            ['name' => 'Code-A-Thon', 'category' => 'Algorithm', 'sub_category' => 'Coding', 'fees' => 0.00, 'description' => '24-hour hackathon to build revolutionary solutions.'],
            ['name' => 'Robo-Wars', 'category' => 'Algorithm', 'sub_category' => 'Robotics', 'fees' => 0.00, 'description' => 'Destruction in the neon-lit octagon. Mechanical supremacy.'],
            ['name' => 'VR Mystery Room', 'category' => 'Algorithm', 'sub_category' => 'VR', 'fees' => 0.00, 'description' => 'Step into the simulation and solve the rift mystery.'],

            // Soft Skills - Training Tracks
            ['name' => 'Persuasive Communication', 'category' => 'softskill', 'sub_category' => 'Communication', 'fees' => 0.00, 'activity_points' => 20, 'description' => 'Master the art of storytelling and public speaking. Pitch with confidence.'],
            ['name' => 'Leadership & Ethics', 'category' => 'softskill', 'sub_category' => 'Leadership', 'fees' => 0.00, 'activity_points' => 25, 'description' => 'Developing value-driven leaders for complex global challenges.'],
            ['name' => 'Conflict Resolution', 'category' => 'softskill', 'sub_category' => 'Negotiation', 'fees' => 0.00, 'activity_points' => 15, 'description' => 'Turn disagreements into growth opportunities. Negotiation tactics.'],

            // Cultural - Upcoming Celebrations
            ['name' => 'ONAM', 'category' => 'Cultural', 'sub_category' => 'Festival', 'fees' => 0.00, 'description' => 'Experience the colors of Kerala with Pookalam competitions, traditional Sadya, and cultural performances.'],
            ['name' => 'CHRISTMAS', 'category' => 'Cultural', 'sub_category' => 'Festival', 'fees' => 0.00, 'description' => 'Joyous celebrations featuring Carol singing, Star decorations, and the spirit of Christmas.'],
            ['name' => 'ASSOCIATION DAY', 'category' => 'Cultural', 'sub_category' => 'Showcase', 'fees' => 0.00, 'description' => 'Technical and cultural showcase by each branch association, celebrating excellence and innovation.'],
            ['name' => 'FAREWELL', 'category' => 'Cultural', 'sub_category' => 'Celebration', 'fees' => 0.00, 'description' => 'A grand send-off for our final year students, filled with memories and well wishes.'],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(['name' => $event['name']], $event);
        }
    }
}
