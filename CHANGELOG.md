# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]
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

### Changed
- Moved generated code to its own folder
- DRY'ed up search helpers
- Renamed pushbot to workflow

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

[Unreleased]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.1.0...HEAD
[0.1.0]: https://github.com/catalyticlabs/catalytic-sdk-php/compare/0.0.1...0.1.0
[0.0.1]: https://github.com/catalyticlabs/catalytic-sdk-php/releases/tag/0.0.1
