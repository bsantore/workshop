Vagrant.configure(2) do |config|
  config.vm.box = "phpstorm/phpstorm-base-vm"
  config.vm.network "private_network", ip: "192.168.50.4"
  config.vm.provision "shell",
    inline: "sudo sed -i -e 's,\/var\/www\",\/var\/www\/html\",g' /etc/apache2/sites-available/10-default_vhost_80.conf && sudo apachectl restart"
end
