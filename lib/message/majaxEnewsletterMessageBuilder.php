<?php
/**
 * Created by JetBrains PhpStorm.
 * User: jmather
 * Date: 4/19/11
 * Time: 2:02 AM
 * To change this template use File | Settings | File Templates.
 */
 
class majaxEnewsletterMessageBuilder implements majaxEnewsletterMessageBuilderInterface
{
  /**
   * @var majaxEnewsletterInterface
   */
  private $enewsletter;

  /**
   * @var majaxEnewsletterFormatterInterface
   */
  private $formatter;

  /**
   * @var string
   */
  private $email_class;

  public function __construct(majaxEnewsletterInterface $enewsletter = null, majaxEnewsletterFormatterInterface $formatter = null, $email_class = 'majaxEnewsletterEmailContainer')
  {
    if ($enewsletter !== null)
      $this->setEnewsletter($enewsletter);
    if ($formatter !== null)
      $this->setFormatter($formatter);
    $this->email_class = $email_class;
  }

  public function setEnewsletter(majaxEnewsletterInterface $enewsletter)
  {
    $this->enewsletter = $enewsletter;
  }

  public function setFormatter(majaxEnewsletterFormatterInterface $formatter)
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

    if ($obj instanceof majaxEnewsletterEmailInterface == false)
    {
      throw new InvalidArgumentException('The class "'.$email_class.'" does not implement majaxEnewsletterEmailInterface');
    }

    $this->email_class = $email_class;
  }

  /**
   * @return majaxEnewsletterEmailInterface
   */
  private function getNewEmail()
  {
    return new $this->email_class();

  }

  private function configureFormatter(majaxEnewsletterMessageInterface $message)
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

  public function build(majaxEnewsletterMessageInterface $message)
  {
    if (!$this->enewsletter)
    {
      throw new InvalidArgumentException('No enewsletter has been set.');
    }
    if (!$this->formatter)
    {
      throw new InvalidArgumentException('No formatter has been set.');
    }

    $subscriber = $message->getSubscriber();

    $this->configureFormatter($message);

    $response = $this->getNewEmail();

    $response->setSubject($this->enewsletter->getSubject());
    $response->setFromEmail($this->enewsletter->getFromEmail());
    $response->setFromName($this->enewsletter->getFromName());

    $response->setToEmail($subscriber->getEmail());
    $response->setToName($subscriber->getName());


    $html_body = $this->formatter->render($this->enewsletter->getHtmlBody());
    $text_body = $this->formatter->render($this->enewsletter->getTextBody());


    $enewsletter_vars = array(
      'html' => $html_body,
      'text' => $text_body,
    );

    $this->formatter->setCode('enewsletter', $enewsletter_vars);

    $response->setHtmlContent($this->formatter->render($this->enewsletter->getHtmlBody()));
    $response->setTextContent($this->formatter->render($this->enewsletter->getTextBody()));

    return $response;
  }
}
