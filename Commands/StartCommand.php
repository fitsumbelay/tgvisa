<?php
/**
 * This file is part of the TelegramBot package.
 *
 * (c) Avtandil Kikabidze aka LONGMAN <akalongman@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\Keyboard;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        // $message = $this->getMessage();

        // $chat_id = $message->getChat()->getId();
        // $text    = 'Hi there!' . PHP_EOL . 'Type /help to see all commands!';

        // $data = [
        //     'chat_id' => $chat_id,
        //     'text'    => $text,
        // ];

        // return Request::sendMessage($data);


        $keyboards[] = new Keyboard([
            ['text' => 'REGISTER NOW'],
          
        ]);

        $keyboard = end($keyboards)
        ->setResizeKeyboard(true)
        ->setOneTimeKeyboard(true)
        ->setSelective(false);

         $this->replyToChat( 
            ' Welcome to AMERICAN MIGRATION BUREAU service!' . PHP_EOL .
            'We offer a FREE online referral service to point you' . PHP_EOL . 
            'to an independent ICCRC Immigration Consultant to help guide you through ' . PHP_EOL . 
            'the often complex and time-consuming visa application process.' . PHP_EOL . 
            ' The Migration Bureau does not offer any immigration advice itself,' . PHP_EOL . 
            'but you contract directly with a registered advisor.' . PHP_EOL .' ' . PHP_EOL . 

            'For over 20 years, the MIGRATION BUREAU has referred and helped 30,000 new settlers' .PHP_EOL . 
             'with their dream of living and working abroad. Today, we are one of American`s ' .PHP_EOL . 
             ' leading migration agent referral networks, also offering relocation and settlement referral services.' .PHP_EOL . 

             ' * Please REGISTER NOW Below', [
                'reply_markup' => $keyboard,
             ]
            
            
        );
    }
}
