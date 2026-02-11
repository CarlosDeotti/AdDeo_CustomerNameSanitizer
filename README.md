# AdDeo_CustomerNameSanitaizer Module Documentation
Módulo Magento 2.4.8 (PHP 8.4) que:
- Remove espaços do **First Name** antes de salvar o cliente.
- Registra log em `var/log/customer_name_sanitizer.log`.
- Envia e-mail ao suporte com dados do cliente.
- Inclui testes unitários.

## AdDeo_CustomerNameSanitaizer Module 2ª Fase: Melhorias e Novos Recursos
- Criar cobertura para importação massiva de clientes.

## Instalação
```bash
bin/magento module:enable AdDeo_CustomerNameSanitaizer
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:flush
```
## Uso
Este módulo sanitiza os nomes dos clientes ao serem registrados, registra logs das ações realizadas e envia e-mails ao suporte com os dados do cliente.

## Estrutura de diretórios
```
app/code/AdDeo/CustomerNameSanitaizer/
├─ registration.php
├─ etc/
│  ├─ module.xml
│  ├─ di.xml
│  └─ email_templates.xml
├─ Plugin/
│  └─ CustomerRepositoryPlugin.php
├─ Model/
│  ├─ NameSanitizer.php
│  ├─ CustomerLogger.php
│  └─ Email/
│     └─ Sender.php
├─ Logger/
│  ├─ Logger.php
│  └─ Handler.php
└─ view/
   └─ frontend/
      └─ email/
         └─ customer_registered.html
```

## Testes unitários (PHPUnit)
```
app/code/AdDeo/CustomerNameSanitaizer/Test/Unit/
├─ Model/
│  ├─ NameSanitizerTest.php
│  └─ CustomerLoggerTest.php
└─ Plugin/
   └─ CustomerRepositoryPluginTest.php
```

## Execução dos testes
```bash
vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist \
app/code/AdDeo/CustomerNameSanitaizer/Test/Unit
```
