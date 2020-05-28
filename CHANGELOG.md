# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.3.0] - 2020-05-28
### Changed
- Drop support for PHP 7.2 and PHP 7.3 since we're using Typed Properties and they are only supported starting with PHP 7.4
- Renamed DataTables->replaceWithDataTable to DataTables->replace
- Now throwing specific exceptions instead of letting the internal ApiException get thrown
- Renamed Client to CatalyicClient

## [0.2.0] - 2020-04-29
### Fixed
- Removed unnecessary debug

### Added
- Get credentials method
- Find credentials method
- Revoke credentials method
- Get dataTable method
- Find dataTables method
- Download dataTables method
- Upload dataTables method
- Replace dataTables method
- Get file method
- Find files method
- Download file method
- Upload file method
- Find instances method
- Stop instance method
- Find instance steps method
- Set user agent with sdk version
- Workflow import method
- Workflow export method
- Upload file method

### Changed
- Moved generated code to its own folder
- DRY'ed up search helpers
- Renamed pushbot to workflow
- Renamed files->uploadFile to files->upload
- Renamed files->downloadFile to files->download
- Renamed dataTables->downloadDataTable to dataTables->download
- Renamed dataTables->uploadDataTable to dataTables->upload

### Removed
- Generated model docs

### Fixed
- Invalid search params when searching instances and steps

## [0.1.0] - 2020-04-04
### Added
- Start an instance method
- Complete an instance step method
- External readme
- Changelog

### Changed
- Require php >=7.2
- Refactored the Where class so that you can no longer use static methods, but must first instantiate the class. This eases the ability to mock this class for testing.
- Simplified the way you instantiate a Client. You no longer need to use static methods from the Credentials class.

## [0.0.1] - 2020-03-31
### Added
- Get a pushbot method
- Get an instance method
- Get an instance step method
- Get all steps for a specific instance method
- Get a user method
- Find users method

[Unreleased]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.3.0...HEAD
[0.3.0]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.2.0...0.3.0
[0.2.0]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.0.1...0.1.0
[0.0.1]: https://github.com/catalyticlabs/catalytic-sdk-php/releases/tag/0.0.1
