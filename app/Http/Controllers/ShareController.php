<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShareAdvertisement;
use Illuminate\Support\Facades\Validator;

class ShareController extends Controller
{
    /**
     * Compartilhar anúncio por e-mail
     */
    public function shareByEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'advertisement_id' => 'required|exists:advertisements,id',
            'sender_email' => 'required|email',
            'recipient_emails' => 'required',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'advertisement_url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors' => $validator->errors()
            ], 422);
        }

        $advertisement = Advertisement::findOrFail($request->advertisement_id);
        $recipientEmails = explode(',', $request->recipient_emails);

        // Verificar e filtrar emails inválidos
        $validEmails = array_filter($recipientEmails, function($email) {
            return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        });

        if (empty($validEmails)) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum email válido fornecido'
            ], 422);
        }

        $subject = $request->subject ?: 'Confira este anúncio: ' . $advertisement->title;
        $senderEmail = $request->sender_email;
        $messageContent = $request->message;
        $advertisementUrl = $request->advertisement_url;

        try {
            // Enviar email para cada destinatário
            foreach ($validEmails as $email) {
                Mail::to(trim($email))
                    ->send(new ShareAdvertisement(
                        $advertisement,
                        $senderEmail,
                        $subject,
                        $messageContent,
                        $advertisementUrl
                    ));
            }

            return response()->json([
                'success' => true,
                'message' => 'Emails enviados com sucesso!',
                'count' => count($validEmails)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao enviar email: ' . $e->getMessage()
            ], 500);
        }
    }
}
