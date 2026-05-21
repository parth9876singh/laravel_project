<?php

namespace Database\Seeders;

use App\Models\Interest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Clean up existing data
        User::truncate();
        Profile::truncate();
        Interest::truncate();

        // ─────────────────────────────────────────────────────────────────
        // DEMO: Startup account
        // ─────────────────────────────────────────────────────────────────
        $demoStartup = User::create([
            'name'     => 'Arjun Sharma',
            'email'    => 'startup@demo.com',
            'password' => Hash::make('password'),
            'role'     => 'startup',
        ]);
        Profile::create([
            'user_id'        => (string) $demoStartup->_id,
            'company_name'   => 'AgroSense AI',
            'tagline'        => 'AI-powered farming intelligence',
            'description'    => 'We use AI-powered soil sensors to help farmers increase yield by 40% while reducing water usage. Our platform provides real-time insights, predictive analytics, and automated irrigation controls directly to the farmer\'s mobile device.',
            'industry'       => 'AgriTech',
            'stage'          => 'Growth',
            'location'       => 'Ludhiana, Punjab',
            'website'        => 'https://agrosense.ai',
            'funding_needed' => '₹2 Crore',
            'team_size'      => 8,
            'tags'           => ['AI', 'Sensors', 'Farming', 'IoT'],
        ]);

        // ─────────────────────────────────────────────────────────────────
        // DEMO: Corporate account
        // ─────────────────────────────────────────────────────────────────
        $demoCorporate = User::create([
            'name'     => 'Priya Mehta',
            'email'    => 'corporate@demo.com',
            'password' => Hash::make('password'),
            'role'     => 'corporate',
        ]);
        Profile::create([
            'user_id'      => (string) $demoCorporate->_id,
            'company_name' => 'Reliance Ventures',
            'tagline'      => 'Fueling India\'s next unicorns',
            'description'  => 'Strategic investment arm of Reliance Group looking for breakthrough startups in AgriTech, FinTech and SaaS. We provide not just capital but strategic mentorship, distribution network access and global partnerships.',
            'industry'     => 'SaaS',
            'location'     => 'Mumbai, Maharashtra',
            'website'      => 'https://relianceventures.com',
        ]);

        // ─────────────────────────────────────────────────────────────────
        // 10 Random Startups
        // ─────────────────────────────────────────────────────────────────
        $startupsData = [
            [
                'name' => 'Rahul Verma', 'email' => 'rahul@payswift.in',
                'company' => 'PaySwift', 'tagline' => 'Payments at the speed of thought',
                'description' => 'PaySwift is a UPI-based payment gateway built for MSMEs. We enable instant cross-border settlements and offer zero-commission merchant onboarding for the first year.',
                'industry' => 'FinTech', 'stage' => 'Scaling',
                'location' => 'Bengaluru, Karnataka', 'website' => 'https://payswift.in',
                'funding' => '₹5 Crore', 'team' => 22,
                'tags' => ['UPI', 'Payments', 'MSME', 'FinTech'],
            ],
            [
                'name' => 'Sneha Iyer', 'email' => 'sneha@medease.co',
                'company' => 'MedEase', 'tagline' => 'Healthcare for every Indian',
                'description' => 'MedEase connects rural patients with verified urban doctors via telemedicine. We have served over 1 lakh consultations in tier-2 and tier-3 cities across India.',
                'industry' => 'HealthTech', 'stage' => 'Growth',
                'location' => 'Hyderabad, Telangana', 'website' => 'https://medease.co',
                'funding' => '₹3 Crore', 'team' => 15,
                'tags' => ['Telemedicine', 'Rural Health', 'AI Diagnosis'],
            ],
            [
                'name' => 'Vikram Singh', 'email' => 'vikram@learnlaunch.edu',
                'company' => 'LearnLaunch', 'tagline' => 'Making education accessible for all',
                'description' => 'LearnLaunch offers vernacular-language coding and skills training for students in rural India. Our AI tutor adapts in real time to the learner\'s pace and understanding.',
                'industry' => 'EdTech', 'stage' => 'Early Stage',
                'location' => 'Patna, Bihar', 'website' => 'https://learnlaunch.edu',
                'funding' => '₹80 Lakh', 'team' => 6,
                'tags' => ['EdTech', 'Vernacular', 'AI Tutor', 'Rural'],
            ],
            [
                'name' => 'Ananya Bose', 'email' => 'ananya@cropconnect.farm',
                'company' => 'CropConnect', 'tagline' => 'Farm-to-fork, reimagined',
                'description' => 'CropConnect is a B2B marketplace that directly connects farmers with restaurants, hotels and grocery chains. We eliminate middlemen and improve farmer income by up to 35%.',
                'industry' => 'AgriTech', 'stage' => 'MVP',
                'location' => 'Nashik, Maharashtra', 'website' => 'https://cropconnect.farm',
                'funding' => '₹1.5 Crore', 'team' => 9,
                'tags' => ['AgriTech', 'B2B', 'Marketplace', 'Farm-to-Fork'],
            ],
            [
                'name' => 'Karthik Rajan', 'email' => 'karthik@shoplocal.app',
                'company' => 'ShopLocal', 'tagline' => 'Empowering India\'s local businesses',
                'description' => 'ShopLocal is a hyperlocal e-commerce platform that helps kiranas and local retailers go digital. Our platform drives foot traffic and online orders to neighbourhood stores.',
                'industry' => 'E-Commerce', 'stage' => 'Growth',
                'location' => 'Chennai, Tamil Nadu', 'website' => 'https://shoplocal.app',
                'funding' => '₹4 Crore', 'team' => 18,
                'tags' => ['E-Commerce', 'Kirana', 'Hyperlocal', 'D2C'],
            ],
            [
                'name' => 'Divya Nair', 'email' => 'divya@dataminds.ai',
                'company' => 'DataMinds', 'tagline' => 'Turning raw data into revenue',
                'description' => 'DataMinds provides no-code AI analytics to mid-size Indian enterprises. Our platform reduces time-to-insight from weeks to hours with drag-and-drop dashboards.',
                'industry' => 'AI/ML', 'stage' => 'Scaling',
                'location' => 'Pune, Maharashtra', 'website' => 'https://dataminds.ai',
                'funding' => '₹6 Crore', 'team' => 30,
                'tags' => ['AI/ML', 'Analytics', 'No-Code', 'SaaS'],
            ],
            [
                'name' => 'Arun Pillai', 'email' => 'arun@solargrid.energy',
                'company' => 'SolarGrid', 'tagline' => 'Clean energy for a billion Indians',
                'description' => 'SolarGrid installs and manages community solar microgrids in rural and peri-urban areas. Our pay-per-use model makes solar affordable without upfront investment.',
                'industry' => 'CleanEnergy', 'stage' => 'Early Stage',
                'location' => 'Jaipur, Rajasthan', 'website' => 'https://solargrid.energy',
                'funding' => '₹2.5 Crore', 'team' => 11,
                'tags' => ['Solar', 'Microgrid', 'CleanEnergy', 'Rural'],
            ],
            [
                'name' => 'Meera Gupta', 'email' => 'meera@fasthaul.in',
                'company' => 'FastHaul', 'tagline' => 'Last-mile logistics, redefined',
                'description' => 'FastHaul is an electric-vehicle powered last-mile logistics platform. We have a network of 200+ EV delivery partners across Delhi NCR and are expanding to 10 more cities.',
                'industry' => 'Logistics', 'stage' => 'Growth',
                'location' => 'New Delhi, Delhi', 'website' => 'https://fasthaul.in',
                'funding' => '₹7 Crore', 'team' => 45,
                'tags' => ['Logistics', 'EV', 'Last-Mile', 'Green'],
            ],
            [
                'name' => 'Rohan Desai', 'email' => 'rohan@edureachapp.com',
                'company' => 'EduReach', 'tagline' => 'Every child deserves world-class learning',
                'description' => 'EduReach provides offline-capable learning tablets preloaded with NCERT and CBSE content for schools in low-connectivity zones. We partner with state governments and NGOs.',
                'industry' => 'EdTech', 'stage' => 'Scaling',
                'location' => 'Lucknow, Uttar Pradesh', 'website' => 'https://edureachapp.com',
                'funding' => '₹10 Crore', 'team' => 60,
                'tags' => ['EdTech', 'NCERT', 'Offline', 'GovTech'],
            ],
            [
                'name' => 'Pooja Reddy', 'email' => 'pooja@healthfirst.care',
                'company' => 'HealthFirst', 'tagline' => 'Preventive healthcare made personal',
                'description' => 'HealthFirst is a corporate wellness SaaS platform that tracks employee health metrics, offers personalised diet/exercise plans and integrates with insurance providers for premium discounts.',
                'industry' => 'HealthTech', 'stage' => 'MVP',
                'location' => 'Bengaluru, Karnataka', 'website' => 'https://healthfirst.care',
                'funding' => '₹1 Crore', 'team' => 7,
                'tags' => ['HealthTech', 'Corporate Wellness', 'SaaS', 'Insurance'],
            ],
        ];

        $startupUsers = [];
        foreach ($startupsData as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
                'role'     => 'startup',
            ]);
            Profile::create([
                'user_id'        => (string) $user->_id,
                'company_name'   => $data['company'],
                'tagline'        => $data['tagline'],
                'description'    => $data['description'],
                'industry'       => $data['industry'],
                'stage'          => $data['stage'],
                'location'       => $data['location'],
                'website'        => $data['website'],
                'funding_needed' => $data['funding'],
                'team_size'      => $data['team'],
                'tags'           => $data['tags'],
            ]);
            $startupUsers[] = $user;
        }
        // Include demo startup
        $startupUsers[] = $demoStartup;

        // ─────────────────────────────────────────────────────────────────
        // 5 Random Corporates
        // ─────────────────────────────────────────────────────────────────
        $corporatesData = [
            [
                'name' => 'Rajesh Tata', 'email' => 'rajesh@tatainnovations.com',
                'company' => 'Tata Innovations', 'tagline' => 'Innovation at the core of everything',
                'description' => 'Tata Innovations is the corporate venture arm of Tata Group, investing in deep-tech, mobility and sustainability startups across India and Southeast Asia.',
                'industry' => 'SaaS', 'location' => 'Mumbai, Maharashtra', 'website' => 'https://tatainnovations.com',
            ],
            [
                'name' => 'Sita Krishnan', 'email' => 'sita@infosysventures.com',
                'company' => 'Infosys Ventures', 'tagline' => 'Backing the builders of tomorrow',
                'description' => 'Infosys Ventures focuses on enterprise software, AI and cybersecurity startups. We provide not just capital but access to Infosys\'s 300,000+ enterprise clients globally.',
                'industry' => 'AI/ML', 'location' => 'Bengaluru, Karnataka', 'website' => 'https://infosysventures.com',
            ],
            [
                'name' => 'Amit Mahindra', 'email' => 'amit@mahindracapital.com',
                'company' => 'Mahindra Capital', 'tagline' => 'Growing with India\'s entrepreneurs',
                'description' => 'Mahindra Capital invests in AgriTech, CleanEnergy and Logistics startups with strong rural India focus. We bring sector expertise and a vast distribution network.',
                'industry' => 'AgriTech', 'location' => 'Mumbai, Maharashtra', 'website' => 'https://mahindracapital.com',
            ],
            [
                'name' => 'Neha Patel', 'email' => 'neha@hdfcgrowth.com',
                'company' => 'HDFC Growth Fund', 'tagline' => 'Empowering the next growth story',
                'description' => 'HDFC Growth Fund specialises in FinTech and HealthTech series-A investments. We have backed 40+ startups with a combined valuation of ₹18,000 Crore.',
                'industry' => 'FinTech', 'location' => 'Mumbai, Maharashtra', 'website' => 'https://hdfcgrowth.com',
            ],
            [
                'name' => 'Suresh Wipro', 'email' => 'suresh@wiproventures.com',
                'company' => 'Wipro Ventures', 'tagline' => 'Technology-first venture investing',
                'description' => 'Wipro Ventures backs early-to-growth stage startups in AI/ML, SaaS and EdTech. Portfolio companies get strategic access to Wipro\'s engineering talent and global client base.',
                'industry' => 'SaaS', 'location' => 'Bengaluru, Karnataka', 'website' => 'https://wiproventures.com',
            ],
        ];

        $corporateUsers = [];
        foreach ($corporatesData as $data) {
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make('password'),
                'role'     => 'corporate',
            ]);
            Profile::create([
                'user_id'      => (string) $user->_id,
                'company_name' => $data['company'],
                'tagline'      => $data['tagline'],
                'description'  => $data['description'],
                'industry'     => $data['industry'],
                'location'     => $data['location'],
                'website'      => $data['website'],
            ]);
            $corporateUsers[] = $user;
        }
        // Include demo corporate
        $corporateUsers[] = $demoCorporate;

        // ─────────────────────────────────────────────────────────────────
        // Pre-seeded interests: each corporate → 3 random startups
        // ─────────────────────────────────────────────────────────────────
        $messages = [
            "We reviewed your profile and see a strong alignment with our investment thesis. We'd love to schedule a discovery call to explore synergies.",
            "Our team was impressed by your traction. Would love to explore a pilot partnership with you.",
            "We believe your technology has potential to scale across our portfolio network. Let's connect.",
            "Your approach to the problem is novel and fits our current focus areas. Looking forward to a conversation.",
            "We have been tracking your space closely and feel your team has the right DNA for success. Let's talk.",
            "The market gap you are addressing is real and urgent. Our fund would love to support your next stage of growth.",
            "Impressive team credentials and early metrics. This is exactly the kind of company we back at this stage.",
            "Your product demo caught our attention. We see clear enterprise use cases. Let's explore a commercial partnership.",
        ];

        $statuses = ['pending', 'pending', 'accepted', 'pending', 'rejected', 'accepted'];

        foreach ($corporateUsers as $corporate) {
            // Pick 3 unique random startups for each corporate
            $selectedKeys = array_rand($startupUsers, min(3, count($startupUsers)));
            if (!is_array($selectedKeys)) {
                $selectedKeys = [$selectedKeys];
            }

            foreach ($selectedKeys as $idx => $key) {
                $startup = $startupUsers[$key];

                // Avoid duplicate (demo corporate + demo startup already linked above)
                $exists = Interest::where('corporate_id', (string) $corporate->_id)
                    ->where('startup_id', (string) $startup->_id)
                    ->exists();
                if ($exists) continue;

                Interest::create([
                    'corporate_id' => (string) $corporate->_id,
                    'startup_id'   => (string) $startup->_id,
                    'message'      => $messages[array_rand($messages)],
                    'status'       => $statuses[array_rand($statuses)],
                ]);
            }
        }

        $this->command->info('✅ DemoSeeder completed: users, profiles, and interests seeded.');
    }
}
