<?php


namespace App\Mailer;

use App\Entity\Contact;
use Exception;
use Psr\Log\LoggerInterface;
use Swift_Mailer;
use Symfony\Component\Translation\TranslatorInterface;
use Twig\Environment;

/**
 * Mailing a new contact to receiver.
 */
class ContactMailSender
{
    /**
     * @var Environment $twig
     */
    private $twig;

    /**
     * @var Swift_Mailer $mailer
     */
    private $mailer;

    /**
     * @var TranslatorInterface $translator
     */
    private $translator;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * @param Environment         $twig
     * @param Swift_Mailer        $mailer
     * @param TranslatorInterface $translator
     * @param LoggerInterface     $logger
     */
    public function __construct
    (
        Environment $twig,
        Swift_Mailer $mailer,
        TranslatorInterface $translator,
        LoggerInterface $logger
    )
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
        $this->translator = $translator;
        $this->logger = $logger;
    }

    /**
     * @param Contact $contact
     * @param string  $receiver
     *
     * @throws Exception
     */
    public function send(Contact $contact, string $receiver): void
    {
        try {
            $this->tryRenderAndSendEmail($contact, $receiver);
        } catch (Exception $exception) {
            $this->handleException($exception);
        }
    }

    /**
     * @param Contact $contact
     * @param string  $receiver
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    private function tryRenderAndSendEmail(Contact $contact, string $receiver): void
    {
        $mailContent = $this->twig->render('mail/new_contact.html.twig', [
            'contact' => $contact,
        ]);

        $message = $this->mailer->createMessage()
            ->setSubject($this->translator->trans('mail.new_contact.title'))
            ->setFrom($contact->getEmail())
            ->setTo($receiver)
            ->setBody($mailContent, 'text/html');

        $this->mailer->send($message);
    }

    /**
     * @param Exception $exception
     *
     * @throws Exception
     */
    private function handleException(Exception $exception): void
    {
        $this->logger->error('Rendering e-mail template failed', $exception);
        throw $exception;
    }
}