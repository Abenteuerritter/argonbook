# -*- mode: ruby -*-
# vi: set ft=ruby sw=2 ts=2 :

Vagrant.configure("2") do |config|
  config.vm.box = "debian/jessie64"

  config.vm.define "argonbook.local" do |dev|
    dev.vm.hostname = "argonbook.local"
    dev.vm.network "private_network", ip: "192.168.42.101"
    dev.vm.synced_folder ".", "/vagrant", disabled: true
    dev.vm.synced_folder ".", "/home/vagrant/argonbook", type: "nfs"
  end

  config.hostmanager.enabled     = true
  config.hostmanager.manage_host = true

  ["vmware_fusion", "vmware_workstation", "virtualbox"].each do |provider|
    config.vm.provider provider do |v, override|
      v.memory = 2048
    end
  end
end
