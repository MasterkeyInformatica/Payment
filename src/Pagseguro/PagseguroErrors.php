<?php namespace Masterkey\Payment\Pagseguro;

    use Exception;

    /**
     * PagseguroErrors
     *
     * Classe que gerencia os erros gerados pela API do Pagseguro
     *
     * @author  Matheus Lopes Santos <fale_com_lopez@hotmail.com>
     * @version 1.0.0
     * @since   21/06/2016
     */
    class PagseguroErrors
    {
        /**
         * Recebe os erros vindos do pagseguro
         *
         * @var array
         */
        protected $receivedErrors;

        /**
         * Separa os error recebidos para retorno ao usuário
         *
         * @var array
         */
        protected $generatedErrors = [];

        /**
         * Códigos de erro e traduções dos erros da API
         *
         * @var array
         */
        protected $errors = [
            5003    => 'Falha de comunicação com a instituição financeira.',
            10000   => 'Bandeira do cartão inválida',
            10001   => 'número do cartão com tamanho inválido',
            10002   => 'Formato de data inválido',
            10003   => 'Código de segurança inválido',
            10004   => 'CVV é obrigatório',
            10006   => 'campo de segurança com tamanho inválido',
            53004   => 'Quantidade inválida de items',
            53005   => 'A moeda é necessária',
            53006   => 'Nome de moeda inválido',
            53007   => 'Tamanho de referência inválido',
            53008   => 'Tamanho da URL de notificação inválida',
            53009   => 'Valor inválido para URL de notificação',
            53010   => 'E-mail do remetente é necessário',
            53011   => 'Tamanho do E-mail do remetente inválido',
            53012   => 'E-mail do remetente inválido',
            53013   => 'Nome do remetente obrigatório',
            53014   => 'Tamanho inválido para o nome do remetente',
            53015   => 'Valor inválido para o nome do remetente',
            53017   => 'Número do CPF inválido',
            53018   => 'Código de area obrigatório',
            53019   => 'Código de área inválido',
            53020   => 'Telefone obrigatório.',
            53021   => 'Telefone inválido',
            53022   => 'CEP é obrigatório',
            53023   => 'CEP inválido',
            53024   => 'Endereço obrigatório',
            53025   => 'Endereço inválido',
            53026   => 'Nº residência é obrigatório',
            53027   => 'Nº residência inválido',
            53028   => 'Complemento inválido',
            53029   => 'O bairro é obrigatório',
            53030   => 'O bairro é inválido',
            53031   => 'A cidade é obrigatória',
            53032   => 'A cidade é inválida',
            53033   => 'O estado é obrigatório',
            53034   => 'O estado é inválido',
            53035   => 'O país é obrigatório',
            53036   => 'O país é inválido',
            53037   => 'O token do cartão de crédito é obrigatório',
            53038   => 'Quantidade de parcelas é obrigatório.',
            53039   => 'Quantidade de parcelas inválido',
            53040   => 'O valor da parcela é obrigatório.',
            53041   => 'Valor de parcela inválido',
            53042   => 'O titular do cartão é inválido',
            53043   => 'Tamanho inválido para o titular do cartão',
            53044   => 'O titular do cartão é inválido',
            53045   => 'O CPF do titular do cartão é obrigatório',
            53046   => 'O CPF do titular é inválido',
            53047   => 'A data de nascimento do titular é obrigatória',
            53048   => 'A data de nascimento do titular é inválida',
            53049   => 'O cód. de área do titular é obrigatório',
            53050   => 'Código de área do titular é inválido',
            53051   => 'O telefone do titular é inválido',
            53052   => 'O telefone do titular é inválido',
            53053   => 'O CEP de cobrança é obrigatório',
            53054   => 'CEP de cobrança inválido',
            53055   => 'O Enderero de cobrança é obrigatório',
            53056   => 'O Enderero de cobrança é inválido',
            53057   => 'O nº do endereço de cobrança é obrigatório',
            53058   => 'O nº do endereço de cobrança é inválido',
            53059   => 'O complemento de cobrança é inválido',
            53060   => 'O bairro de cobrança é obrigatório.',
            53061   => 'O bairro de cobrança é inválido',
            53062   => 'A cidade de cobrança é obrigatória',
            53063   => 'A cidade de cobrança é inválida',
            53064   => 'O estado de cobrança é obrigatório',
            53065   => 'O estado de cobrança é inválido',
            53066   => 'O país de cobrança é obrigatório',
            53067   => 'O país de cobrança é inválido',
            53068   => 'O e-mail da loja possui um tamanho inválido',
            53069   => 'O e-amil da loja é inválido',
            53070   => 'O ID do item é inválido',
            53071   => 'O tamanho do ID é inválido',
            53072   => 'A descrição do item é obrigatória',
            53073   => 'Tamanho inválido para a descrição',
            53074   => 'A quantidade do item é obrigatória',
            53075   => 'A quantidade do item está fora do intervalo',
            53076   => 'A quantidade é inválida',
            53077   => 'O valor do item é obrigatório',
            53078   => 'Valor do item inválido',
            53079   => 'Valor do item fora do intervalo',
            53081   => 'O cliente está relacionado à loja.',
            53084   => 'Loja inválida. Verifique os dados da loja',
            53085   => 'Método de pagamento indisponível.',
            53086   => 'Valor total do carrinho fora do intervalo',
            53087   => 'Dados do cartão de crédito inválidos',
            53091   => 'Hash de comprador inválido',
            53092   => 'Bandeira do cartão não aceita',
            53095   => 'Tipo de envio inválido',
            53096   => 'Valor de frete inválido',
            53097   => 'Valor do frete fora do intervalo',
            53098   => 'O valor total é negativo',
            53099   => 'Valor extra inválido',
            53101   => 'Modo de pagamento inválido, os valores válidos são default e gateway.',
            53102   => 'Método de pagamento inválido, os valores válidos são creditCard, boleto e eft.',
            53104   => 'Custo de transporte foi fornecido, endereço de entrega deve ser completo',
            53105   => 'Informações do remetente foram fornecidas, e-mail deve ser fornecido também',
            53106   => 'Titular do cartão incompleto.',
            53109   => 'Informações endereço de entrega foram fornecidas, e-mail do remetente deve ser fornecido também',
            53110   => 'Banco para TED é obrigatório.',
            53111   => 'Banco para TED não aceito',
            53115   => 'nascimento do cliente ionválido',
            53117   => 'CNPJ do cliente inválido',
            53122   => 'Domínio de e-mail inválido. Você deve usar um email @sandbox.pagseguro.com.br',
            53140   => 'Qtde de parcelas fora do limite: {0}. O valor deve ser maior que zero.',
            53141   => 'Cliente bloqueado.',
            53142   => 'Token do cartão de crédito inválido',
        ];

        /**
         * Construtor da classe
         *
         * @param   array  $errors
         */
        public function __construct($errors)
        {
            $this->receivedErrors = $errors;
        }

        /**
         * Separa as traduções dos erros e devolve para o usuário
         *
         * @return  array
         * @throws  Exception
         */
        public function getErrors()
        {
            if(count($this->receivedErrors)) {
                foreach($this->receivedErrors['error'] as $error) {
                    $this->generatedErrors[] = $this->errors[$error['code']];
                }

                return $this->generatedErrors;
            } else {
                throw new Exception("O array de erros enviados pelo Pagseguro é inválido", 1);
            }
        }
    }
