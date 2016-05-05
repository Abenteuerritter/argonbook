# -*- mode: ruby -*-
# vi: set ft=ruby sw=2 ts=2 :

Vagrant.configure("2") do |config|
  config.vm.box      = "ubuntu/trusty64"
  config.vm.hostname = "argonbook.local"

  config.vm.network "private_network", ip: "192.168.42.101"

  config.hostmanager.enabled     = true
  config.hostmanager.manage_host = true

  config.vm.synced_folder ".", "/vagrant", disabled: true
  config.vm.synced_folder ".", "/home/vagrant/argonbook", type: "nfs"

  ["vmware_fusion", "vmware_workstation", "virtualbox"].each do |provider|
    config.vm.provider provider do |v, override|
      v.memory = 1024
    end
  end
end
