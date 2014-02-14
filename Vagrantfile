Vagrant.configure('2') do |config|
  config.vm.box = 'debian-6-amd64'
  config.vm.box_url = 'http://s3.cargomedia.ch/vagrant-boxes/debian-6-amd64.box'

  config.vm.hostname = 'www.denkmal.dev'
  config.dns.tld = 'dev'
  config.dns.patterns = [/^.*denkmal.dev$/]

  config.vm.network :private_network, ip: '10.10.10.10'
  config.vm.synced_folder '.', '/vagrant', nfs: true
  config.ssh.forward_agent = true

  config.librarian_puppet.puppetfile_dir = 'puppet'
  config.librarian_puppet.placeholder_filename = '.gitkeep'
  config.vm.provision :puppet do |puppet|
    puppet.module_path = 'puppet/modules'
    puppet.manifests_path = 'puppet/manifests'
  end
end
