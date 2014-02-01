require 'yaml'

symfony_config = YAML.load_file('app/config/config.yml')

set  :application, "argonbook"
set  :domain,      "argonbook.eu"
set  :deploy_to,   "/srv/www/argonbook.eu"

set  :repository,  "git@github.com:Abenteuerritter/argonbook.git"
set  :scm,         :git
set  :deploy_via,  :copy
set  :branch,      "v#{symfony_config['parameters']['project']['version']}"

set  :model_manager, "doctrine"

role :app, domain, :primary => true
role :web, domain

set  :shared_files,    ["app/config/parameters.yml"]
set  :shared_children, ["vendor"]

set  :writable_dirs,        ["app/cache", "app/logs"]
set  :webserver_user,       "www-data"

set  :use_set_permissions,  true
set  :use_composer,         true
set  :use_sudo,             false
set  :interactive_mode,     false
set  :keep_releases,        3

logger.level = Logger::MAX_LEVEL
