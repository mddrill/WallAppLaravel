<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\User;

class PostsTableSeeder extends Seeder
{
    public $text_arr = [
                    "Once upon a midnight dreary, while I pondered weak and weary,",
                    "Over many a quaint and curious volume of forgotten lore, ",
                    "While I nodded, nearly napping, suddenly there came a tapping,",
                    "As of some one gently rapping, rapping at my chamber door.",
                    "'Tis some visitor,' I muttered, tapping at my chamber door -",
                    "Only this, and nothing more.'",
                    "Ah, distinctly I remember it was in the bleak December,",
                    "And each separate dying ember wrought its ghost upon the floor.",
                    "Eagerly I wished the morrow; - vainly I had sought to borrow",
                    "From my books surcease of sorrow - sorrow for the lost Lenore -",
                    "For the rare and radiant maiden whom the angels name Lenore -",
                    "Nameless here for evermore.",
                    "And the silken sad uncertain rustling of each purple curtain",
                    "Thrilled me - filled me with fantastic terrors never felt before;",
                    "So that now, to still the beating of my heart, I stood repeating",
                    "'Tis some visitor entreating entrance at my chamber door -",
                    "Some late visitor entreating entrance at my chamber door; -",
                    "This it is, and nothing more,'",
                    "Presently my soul grew stronger; hesitating then no longer,",
                    "Sir,' said I, `or Madam, truly your forgiveness I implore;"
                ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<20; $i++) {
            Post::create(array(
                'author_id' => ($i+2)%3+1,
                'text' => $this->text_arr[$i]
            ));
        }
    }
}