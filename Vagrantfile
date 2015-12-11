# -*- mode: ruby -*-
# vi: set ft=ruby sw=2 ts=2 :

VAGRANTFILE_API_VERSION = "2"

domain = 'argonbook.local'
ip = '192.168.42.101'

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = 'ubuntu/trusty32'
  config.vm.hostname = domain
  config.vm.network 'private_network', ip: ip
  config.vm.synced_folder "./" , "/srv/www/" + domain + "/current/", :mount_options => ["dmode=777", "fmode=666"]
  config.vm.synced_folder ".", "/vagrant", disabled: true

  config.vm.provider "virtualbox" do |virtualbox|
    virtualbox.customize ['modifyvm', :id,
      '--name', domain,
      '--memory', "1024"
    ]
    #virtualbox.customize ['setextradata', :id, "VBoxInternal2/SharedFoldersEnableSymlinksCreate/v-root", "1"]
  end

  config.vm.provision "ansible" do |ansible|
    ansible.playbook = "app/provision/site.yml"
    ansible.extra_vars = {
      env: "dev",
      domain: domain,
      ip: ip,
    }
  end
end

