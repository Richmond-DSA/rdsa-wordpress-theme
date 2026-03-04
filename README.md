# DSA Richmond Wordpress Theme
Made with love by the socialists at the Richmond Democratic Socialists of America!

## Custom Post Types
Our theme uses 2 primary custom post types: Initiatives and Resources

### Initiatives
Initiatives are a custom post type that is used for our working groups and priority campaigns.

### Resources
Resource pages are used for resource items that the chapter posesses, such as documentation, guides, meeting notes etc.

## Adding plugins to wp-env.json
1. Navigate to plugin page of plugin you wish to add
2. Open wp-env.json file
3. Add download zip from the plugin page to plugins section of wp-env.
4. Remove the version from the zip download, if any.
5. Commit

## Getting Started
1. ```npm i```
2. ```npm run wp-env start``` installs and starts the docker container.
3. ```npm run wp-env stop``` stops the docker container

## Useful Commands
- ```npm run wp-env -- --debug``` - Starts the docker container in debug mode
- ```npm run wp-env destroy``` - destroys the docker container. Destructive.

## Need help? Consult these resources
- [Setting Up a Modern WordPress Development Environment Using wp-env](https://wp-block-editor.com/setting-up-a-modern-wordpress-development-environment-using-wp-env/)
- [wp-env documentation](https://www.npmjs.com/package/@wordpress/env)