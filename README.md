# HTTP Client Welcome
My Drupal 8 custom module requires the Drupal 8 contributed module HTTP Client Manager.

## How to Start

#### Steps to install my custom module.

1. Download and Install [Drupal 8](https://www.drupal.org/docs/8/install) or Install through Composer [Drupal project](https://www.drupal.org/docs/develop/using-composer/using-composer-to-install-drupal-and-manage-dependencies).
2. Download and Install [HTTP Client Manager](https://www.drupal.org/project/http_client_manager) through Composer as recommended.
3. Clone and Install [http_client_welcome](https://github.com/frankthoeny/http_client_welcome)

### DDEV Composer CheatSheet

#### Start a new Drupal site with DDEV Composer Create-Project in 12 steps.
Credits: 
Michael Anello, @ultimike, DrupalEasy, 2018
Italy [bmeme](http://www.bmeme.com/)
Minor Revision: Frank Thoeny, 2022

1. Go to Powershell and run the command WSL --shutdown. 

2. Go to WSL(Ubuntu Linux). It's a bit of directory/file juggling, but it's simple enough and it seems to be pretty bullet-proof. I'm open to suggestions on how to improve it.

3. Create a new, empty, project directory, then Navigate into the new project directory (mkdir project-name && cd project-name).

4. Run (ddev config --projecttype drupal8 --sitename project-name --docroot . ). This will result in a .ddev directory in your project directory.

5. Run (ddev start) to create the containers.

6. Run (ddev exec composer create-project drupal-composer/drupal-project:8.x-dev temp --stability dev) - this will result in a Drupal 8 codebase in a directory named "temp" in your project directory.

7. Run (mv temp/* temp/.* .) to move the entire contents of the temp directory into your project directory. This will result in the temp directory being empty, and a "web" directory (among other files and directories) in your project directory (along with your .ddev directory). This command may throw a "cannot move" error or two, but it still works.

8. Run (rm -r temp) to delete the empty "temp" directory.

9. Edit with (VIM) the .ddev/config.yaml file, set: docroot: "web" instead of docroot: .

10. Run (ddev restart)

11. Run (ddev launch) to open localhost in the default browser.

12. Run the Drupal installer (use ddev describe for DB credentials).

## JS Libraries and Frameworks
~~Using Bootstrap 4, Popper and Font Awesome. JQuery is still provided in Drupal 8/9.~~ 
Currently, no need for JS, but can implement in the Yaml libraries and Twig theme.

## CSS Styling
~~Styling with Bootstrap not modified.~~
Using plain vanilla CSS for styling, but can implement in Yaml libraries.

## Twig Templating Engine
Front end Built with HTML and Twig.

### Thank You
There will be more to come. Stay tuned.

