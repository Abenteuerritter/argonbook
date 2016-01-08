# -*- mode: ruby -*-
# vi: set ft=ruby sw=2 ts=2 :

domain = 'argonbook.local'
address = '192.168.42.101'

Vagrant.configure("2") do |config|
  config.vm.box = 'hashicorp/precise64'
  config.vm.hostname = domain
  config.vm.network 'private_network', ip: address

  config.vm.synced_folder "./" , "/srv/www/" + domain + "/current/", :mount_options => ["dmode=777", "fmode=666"]
  config.vm.synced_folder ".", "/vagrant", disabled: true

  config.vm.provider "virtualbox" do |v|
    v.memory = 1024
  end

  config.vm.provision "ansible" do |ansible|
    ansible.playbook = "provisioning/vagrant.yml"
    ansible.extra_vars = { env: "dev", domain: domain, ip: address }
  end
end
