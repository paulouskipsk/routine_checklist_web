<?php
namespace App\Traits\Api;

trait ResponseCreator
{
    /**
     * Método genérico para retorno de Response padrão no sistema.
     * @param bool $status Status da requisição: true, se ocorreu tudo como esperado e false, se ocorreu algum erro no processo..
     * @param int $statusCode Codigo do status Http que dese ser retornado.
     * @param string $message Mensagem que será exibida para o usuário.
     * @param array $payload Carga útil que será enviado na requisição com as informações requeridas (array associativo).
     * @param array $erros Array de erros caso existam. Deve ser 'String' simples para exibir para cliente.
     * @return Json formatado com response padrão para o sistema.
     */
    public function response(bool $status, int $statusCode, string $message, array $payload=[], array $erros=[])
    {
        return response()->json([
            "status" => $status,
            "status-code" => $statusCode,
            "message" => $message,
            "payload" => $payload,
            "errors" => $erros
        ], $statusCode);
    }

    /**
     * Método específico para retorno de Response padrão no sistema quando a requisição é sucesso.
     * as informações: status = true, status-code = 200, errors = [], são enviados com os valores pré definidos.
     * @param string $message Mensagem de será exibida para o usuário.
     * @param array $payload Carga útil que será enviado na requisição com as informações requeridas (array associativo).
     * @return Json formatado com response padrão para o sistema.
     */
    public function responseOk(string $message, array $payload=[])
    {
        return response()->json([
            "status" => true,
            "status-code" => 200,
            "message" => $message,
            "payload" => $payload,
            "errors" => []
        ], 200);
    }

     /**
     * Método específico para retorno de Response padrão no sistema quando a requisição é falha.
     * as informações: status = false, status-code = 400, payload = [] são enviados com valores pré definidos.
     * @param string $message Mensagem de será exibida para o usuário.
     * @param array $payload Carga útil que será enviado na requisição com as informações requeridas (array associativo).
     * @return Json formatado com response padrão para o sistema.
     */
    public function responseError(string $message, array $erros=[], array $payload=[])
    {
        return response()->json([
            "status" => false,
            "status-code" => 400,
            "message" => $message,
            "payload" => $payload,
            "errors" => empty($erros) ? [$message] : $erros
        ], 400);
    }
    
}