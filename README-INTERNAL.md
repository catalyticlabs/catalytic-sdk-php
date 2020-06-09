## Internal Docs
> Documentation related to development of this project

## Regenerate

The `/lib/generated` folder is generated using [OpenAPI Generator](https://openapi-generator.tech).

To regenerate the code, you'll probably need to update the url in `./regenerate` and then run the command:

```sh
$ composer run-script regenerate
```

## Tests

To run the unit tests:

```sh
$ composer test
```

Or to run the unit tests with colors, run the command manually:

```sh
$ ./vendor/bin/phpunit tests --testdox
```

## Publishing

1. Update the version in `.version`
2. Update `CHANGELOG.md`
3. Create a release in github or a git tag manually