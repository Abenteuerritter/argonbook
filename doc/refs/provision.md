# Provision

## Configuration

Configuration variables and it's defaults.

    | Variable              | Default | Propose                      |
    | --------------------- | ------- | ---------------------------- |
    | `user`                |         | User to run as               |
    | `domain`              |         | Hostname                     |
    | `packages`            | `[]`    | List of packages to install  |
    | `php_memory_limit`    | `128M`  | Maximum PHP memory usage     |
    | `db_buffer_pool_size` | `128M`  | InnoDB buffer pool size      |

## Virtual Machine

    $ vagrant up
    $ vagrant ssh-config >> ~/.ssh/config
    $ ansible-playbook -i etc/hosts/localdev.ini etc/provision.yml
