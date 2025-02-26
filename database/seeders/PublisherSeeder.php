<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $data = [
      ['name' => 'Penguin Random House'],
      ['name' => 'HarperCollins'],
      ['name' => 'Macmillan'],
      ['name' => 'Simon & Schuster'],
      ['name' => 'Hachette Livre'],
      ['name' => 'Pearson'],
      ['name' => 'Scholastic'],
      ['name' => 'Oxford University Press'],
      ['name' => 'Cambridge University Press'],
      ['name' => 'Wiley'],
      ['name' => 'Springer Nature'],
      ['name' => 'Routledge'],
      ['name' => 'McGraw-Hill'],
      ['name' => 'Elsevier'],
      ['name' => 'Bloomsbury'],
      ['name' => 'Cengage Learning'],
      ['name' => 'Harvard University Press'],
      ['name' => 'MIT Press'],
      ['name' => 'University of California Press'],
      ['name' => 'SAGE Publications'],
      ['name' => 'Taylor & Francis'],
      ['name' => 'Kendall Hunt Publishing'],
      ['name' => 'Rowman & Littlefield'],
      ['name' => 'Pearson Education'],
      ['name' => 'Alfred A. Knopf'],
      ['name' => 'Little, Brown and Company'],
      ['name' => 'Beacon Press'],
      ['name' => 'St. Martin\'s Press'],
      ['name' => 'New York University Press'],
      ['name' => 'Farrar, Straus and Giroux'],
      ['name' => 'Viking Press'],
      ['name' => 'Tyndale House Publishers'],
      ['name' => 'Zondervan'],
      ['name' => 'HarperOne'],
      ['name' => 'WaterBrook & Multnomah'],
      ['name' => 'Thomas Nelson'],
      ['name' => 'Houghton Mifflin Harcourt'],
      ['name' => 'Kendall Hunt'],
      ['name' => 'John Wiley & Sons'],
      ['name' => 'Pearson Longman'],
      ['name' => 'Allyn & Bacon'],
      ['name' => 'Prentice Hall'],
      ['name' => 'Addison-Wesley'],
      ['name' => 'Benjamin Cummings'],
      ['name' => 'Upper Saddle River'],
      ['name' => 'Merriam-Webster'],
      ['name' => 'Dorling Kindersley'],
      ['name' => 'Chronicle Books'],
      ['name' => 'Perseus Books'],
      ['name' => 'MIT Press'],
      ['name' => 'Yale University Press'],
      ['name' => 'University of Chicago Press'],
      ['name' => 'Penguin Books'],
      ['name' => 'Farrar Straus Giroux'],
      ['name' => 'W.W. Norton & Company'],
      ['name' => 'Grove Press'],
      ['name' => 'Knopf Doubleday Publishing Group'],
      ['name' => 'Riverhead Books'],
      ['name' => 'The New Press'],
      ['name' => 'Ecco Press'],
      ['name' => 'Harcourt Brace'],
      ['name' => 'Orion Publishing Group'],
      ['name' => 'Crown Publishing Group'],
      ['name' => 'Simon & Schuster'],
      ['name' => 'Workman Publishing'],
      ['name' => 'Andrews McMeel Publishing'],
      ['name' => 'Random House'],
      ['name' => 'Scribner'],
      ['name' => 'St. Martin\'s Press'],
      ['name' => 'Atria Books'],
      ['name' => 'Plume'],
      ['name' => 'Viking'],
      ['name' => 'G.P. Putnam\'s Sons'],
      ['name' => 'Doubleday'],
      ['name' => 'Ballantine Books'],
      ['name' => 'Alfred A. Knopf'],
      ['name' => 'Berkley Books'],
      ['name' => 'Penguin Press'],
      ['name' => 'Riverside Publishing'],
      ['name' => 'Harper Design'],
      ['name' => 'Liveright'],
      ['name' => 'Miramax Books'],
      ['name' => 'Parallax Press'],
      ['name' => 'Deerfield Beach'],
      ['name' => 'Hay House'],
      ['name' => 'Jovian Press'],
      ['name' => 'Lion Hudson'],
      ['name' => 'WordWorks Publishing'],
      ['name' => 'New World Library'],
      ['name' => 'Rowman & Littlefield'],
      ['name' => 'Page Street Publishing'],
      ['name' => 'Skyhorse Publishing'],
      ['name' => 'Redleaf Press'],
      ['name' => 'Harmony Books'],
      ['name' => 'IndieBound'],
      ['name' => 'F+W Media'],
      ['name' => 'Sasquatch Books'],
      ['name' => 'Viva Editions'],
      ['name' => 'Cleis Press'],
      ['name' => 'Sourcebooks'],
      ['name' => 'Workman'],
      ['name' => 'Hachette Book Group'],
      ['name' => 'Lulu Press'],
      ['name' => 'Shambhala Publications'],
      ['name' => 'Macmillan Publishers'],
      ['name' => 'Amacom'],
      ['name' => 'Harvard Business Press'],
      ['name' => 'Capstone'],
      ['name' => 'Bantam'],
    ];

    Publisher::insert(array_map(function ($item) {
      return array_merge($item, [
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }, $data));
  }
}
