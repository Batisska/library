<?php


namespace App\Data\Dto;



use Spatie\DataTransferObject\Reflection\DataTransferObjectClass;

/**
 * Class UserData
 * @package App\Data\Dto
 */
class AuthorData extends DataTransferObjectClass
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $email;

    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $created_at;
    /**
     * @var string
     */
    public string $updated_at;

  /*  public static function from(array $params): AuthorData
    {
        return new self([
            'id' => $params['id'],
            'email' => $params['first_name'],
            'last_name' => $params['last_name'],
            'created_at' => $params['created_at'],
            'updated_at' => $params['updated_at'],
        ]);

    }*/
}
