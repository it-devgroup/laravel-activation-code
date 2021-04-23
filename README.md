## 
## Install for Lumen

**1.** Open file `bootstrap/app.php` and add new service provider
```
$app->register(\ItDevgroup\LaravelActivationCode\Providers\ActivationCodeServiceProvider::class);
```
Uncommented strings
```
$app->withFacades();
$app->withEloquent();
```
Added after **$app->configure('app');**
```
$app->configure('activation_code');
```

**2.** Run commands

For creating config file
```
php artisan activation:code:publish --tag=config
```
For creating migration file
```
php artisan activation:code:publish --tag=migration
```
For generate table
```
php artisan migrate
```

## Install for laravel

**1.** Open file **config/app.php** and search
```
    'providers' => [
        ...
    ]
```
Add to section
```
        \ItDevgroup\LaravelActivationCode\Providers\ActivationCodeServiceProvider::class,
```
Example
```
    'providers' => [
        ...
        \ItDevgroup\LaravelActivationCode\Providers\ActivationCodeServiceProvider::class,
    ]
```

**2.** Run commands

For creating config file
```
php artisan vendor:publish --provider="ItDevgroup\LaravelActivationCode\Providers\ActivationCodeServiceProvider" --tag=config
```
For creating migration file
```
php artisan activation:code:publish --tag=migration
```
For generate table
```
php artisan migrate
```

## ENV variables

File .env

Total of attempt for enter code
```
ACTIVATION_CODE_DEFAULT_MAX_ATTEMPT=5
```

Total of attempt for enter code (for sms mode)
```
ACTIVATION_CODE_SMS_MAX_ATTEMPT=5
```

Generate code mode
```
ACTIVATION_CODE_DEFAULT_GENERATE_MODE=5
```

Generate code mode (for sms mode)
```
ACTIVATION_CODE_SMS_GENERATE_MODE=4
```

Code length
```
ACTIVATION_CODE_DEFAULT_CODE_LENGTH=20
```

Code length (for sms mode)
```
ACTIVATION_CODE_SMS_CODE_LENGTH=5
```

Code TTL
```
ACTIVATION_CODE_DEFAULT_CODE_TTL=1h
```

Code TTL (for sms mode)
```
ACTIVATION_CODE_SMS_CODE_TTL=5m
```

## Custom model

###### Step 1

Create custom model for activation code

Example:

File: **app/CustomFile.php**

Content:

```
<?php

namespace App;

class CustomFile extends \ItDevgroup\LaravelActivationCode\Model\ActivationCode
{
}
```

If need change table name or need added other code:

```
<?php

namespace App;

class CustomFile extends \ItDevgroup\LaravelActivationCode\Model\ActivationCode
{
    protected $table = 'YOUR_TABLE_NAME';
    
    // other code
}
```

###### Step 2

Open **config/activation_code.php** and change parameter "model", example:

```
...
// remove
'model' => \ItDevgroup\LaravelActivationCode\Model\ActivationCode::class,
// add
'model' => \App\CustomFile::class,
```

## Usage

#### Initialize service

```
$service = app(\ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::class);
```

or injected

```
// use
use ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface;
// constructor
public function __construct(
    ActivationCodeServiceInterface $activationCodeService
)
```

further we will use the variable **$service**

#### Generation code

Returned **\ItDevgroup\LaravelActivationCode\Model\ActivationCode** eloquent model

Basic usage with min parameters

```
$model = $service->make('test@test.com', 'user_register');
```

Usage with parameter

```
$model = $service->make('test@test.com', 'user_register', 10);
// 1 parameter - receiver for code (email, phone or other)
// 2 parameter - type code (context) (user activation, password recovery, confirm order or other)
// 3 parameter - (optional) entity ID
```

#### Check activation code on of valid

Returned **\ItDevgroup\LaravelActivationCode\Model\ActivationCode** eloquent model

If returned model, then code valid

```
$model = $service->get('test@test.com', '12345', 'user_register');
// with extra parameters
$model = $service->get('test@test.com', '12345', 'user_register', true, true);
// 1 parameter - receiver for code (email, phone or other)
// 2 parameter - code
// 3 parameter - type code (context) (user activation, password recovery, confirm order or other)
// 4 parameter - (optional) use exception (true - use (default), false - not use)
// 5 parameter - (optional) disabled attempts for code (true - disable, false - enable (default))
```

#### Delete activation code

Use if you need to activate the code or just delete it

```
$service->delete($model);
```

## Configuring activation code

All configuration is optional depending on the task

Example

```
$service
    ->setMode(\ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::MODE_SMS)
    ->setGenerateCodeMode(\ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALPHABET_LOWER)
    ->setCodeLength(7)
    ->setCodeTTL('20m')
    ->setMaxAttempt(3);
$service
    ->setMode('sms')
    ->setGenerateCodeMode(3)
    ->setCodeLength(7)
    ->setCodeTTL('20m')
    ->setMaxAttempt(5);
```
- **setMode** - code generation mode (null - use default configuration, sms - use configuration for sms mode) (only works for configurations that have not been manually overridden)
- **setGenerateCodeMode** - rule of generation code
- - **ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALPHABET** (1) - only letters, case insensitive
- - **ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALPHABET_LOWER** (2) - only lowercase letters
- - **ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALPHABET_UPPER** (3) - only uppercase letters
- - **ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_NUMBER** (4) - only numbers
- - **ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALL** (5) - (default) letters and numbers
- **setCodeLength** - code length
- **setCodeTTL** - code lifetime, format: 10m (example: 10 - 10 seconds, 10m - 10 minutes, 10h - 10 hours, 10d - 10 days)
- **setMaxAttempt** - maximum number of attempts to enter the code (use when checking code)

#### Reset configuration

- mode
- generationCode
- code length
- code ttl
- max attempt

```
$service->reset();
```

## Example

```
// generate code
$model = $service->make('test@test.com', 'user_register');

// get code
$model = $service->get('test@test.com', '12345', 'user_register');
... you PHP code

// activate of code
$service->delete($model);
```

With custom configuration

```
// custom configuration
$service
    ->setMode(\ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::MODE_SMS)
    ->setGenerateCodeMode(\ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALPHABET_LOWER)
    ->setCodeLength(7)
    ->setCodeTTL('20m')
    ->setMaxAttempt(3);
    
// create code
$model = $service->make('test@test.com', 'user_register');

// get code
$service->setMaxAttempt(3);
$model = $service->get('test@test.com', '12345', 'user_register');
... you PHP code

// activate of code
$service->delete($model);
```
