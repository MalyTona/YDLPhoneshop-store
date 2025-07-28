<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactInfo::create([
            'title_main' => 'ទីតាំង',
            'title_highlight' => 'ហាងយើង',
            'description' => 'សូមអញ្ជើញមកទស្សនាហាងយើងដើម្បីទទួលបានសេវាកម្មដ៏ល្អបំផុត និងផលិតផលគុណភាពខ្ពស់',
            'address' => 'និគមលើ, ស្រឡប់, ខេត្តត្បូងឃ្មុំ',
            'phone_1' => '+855 96 684 4498',
            'phone_2' => '+855 71 600 8881',
            'opening_hours' => 'ចន្ទ - អាទិត្យ: 8:00 AM - 8:00 PM',
            'telegram_link' => 'https://t.me/Yoth_Dalen',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d244.00939069536986!2d105.80145520137164!3d11.894624119961234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2skh!4v1751950619240!5m2!1sen!2skh',
            'map_directions_link' => 'https://maps.app.goo.gl/hMNkK4VozfFg82KWA',
        ]);
    }
}
