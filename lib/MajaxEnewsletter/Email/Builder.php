<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:02 AM
 * To change this template use File | Settings | File Templates.
 */
 
class MajaxEnewsletter_Email_Builder implements MajaxEnewsletter_Email_Builder_Interface
{
  /**
   * @var MajaxEnewsletter_Formatter_Interface
   */
  protected $formatter;

  /**
   * @var string
   */
  protected $email_class;

  public function __construct(MajaxEnewsletter_Formatter_Interface $formatter = null, $email_class = 'MajaxEnewsletter_Email')
  {
    if ($formatter !== null)
      $this->setFormatter($formatter);
    $this->email_class = $email_class;
  }

  public function setFormatter(MajaxEnewsletter_Formatter_Interface $formatter)
  {
    $this->formatter = $formatter;
  }

  public function setEmailClass($email_class)
  {
    if (!class_exists($email_class, true))
    {
      throw new InvalidArgumentException('The class "'.$email_class.'" does not exist.');
    }

    $obj = new $email_class();

    if ($obj instanceof MajaxEnewsletter_Email_Interface == false)
    {
      throw new InvalidArgumentException('The class "'.$email_class.'" does not implement MajaxEnewsletter_Email_Interface');
    }

    $this->email_class = $email_class;
  }

  /**
   * @return MajaxEnewsletter_Email_Interface
   */
  protected function getNewEmail()
  {
    return new $this->email_class();

  }

  protected function configureFormatter(MajaxEnewsletter_QueueEntry_Interface $message)
  {
    $this->formatter->resetCodes();

    $message_vars = array(
      'unique_id' => $message->getUniqueId(),
    );

    $subscriber = $message->getSubscriber();
    $subscriber_vars = array(
      'name' => $subscriber->getName(),
      'email' => $subscriber->getEmail(),
    );

    $this->formatter->setCode('message', $message_vars);
    $this->formatter->setCode('subscriber', $subscriber_vars);
  }

  public function build(MajaxEnewsletter_Message_Interface $enewsletter, MajaxEnewsletter_QueueEntry_Interface $queue_entry)
  {
    if (!$this->formatter)
    {
      throw new InvalidArgumentException('No formatter has been set.');
    }

    $subscriber = $queue_entry->getSubscriber();

    $this->configureFormatter($queue_entry);

    $response = $this->getNewEmail();

    $response->setSubject($enewsletter->getSubject());
    $response->setFromEmail($enewsletter->getFromEmail());
    $response->setFromName($enewsletter->getFromName());

    $response->setToEmail($subscriber->getEmail());
    $response->setToName($subscriber->getName());

    $text_body = $this->formatter->render($enewsletter->getTextBody());
    $this->formatter->setCode('enewsletter', $text_body);
    $response->setTextBody($text_body);
    $response->setTextContent($this->formatter->render($enewsletter->getTemplate()->getTextTemplate()));

    $html_body = $this->formatter->render($enewsletter->getHtmlBody());
    $this->formatter->setCode('enewsletter', $html_body);
    $response->setHtmlBody($html_body);
    $response->setHtmlContent($this->formatter->render($enewsletter->getTemplate()->getHtmlTemplate()));

    return $response;
  }
}
