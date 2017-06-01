# medooch/symfony-Validator

Symfony 3.3 Validator Usage

Without accessing the validator component from container, this is the Simple Way to validate values using symfony validator component where you want.

Usage:
----

    use Symfony\Component\Validator\Constraints\EmailConstraint;
    use Medooch\Components\Validator;

    $value = 'trimechmehdi11@gmail.com';
    $emailConstraint = EmailConstraint();
    $violations = Validator::validate($value, $emailConstraint);
    
    var_dump($violations->count());
