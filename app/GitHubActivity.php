<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GitHubActivity extends Model
{
    /**
     * The base GitHub API URL
     *
     * @var string
     */
    private $api_url = 'https://api.github.com';

    /**
     * The token used for retrieving information from the GitHub API
     *
     * @var string
     */
    private $token;

    /**
     * Create a new instance of the GitHubActivity model
     *
     * @param array     $attributes
     * @return void
     *
     * This is necessary to initialize some properties that can't otherwise be
     * initialized. Initializing properties outside of a constrctor requires
     * that the initial values be static.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->token = config('service.github.token', false);
    }
}
