<?php

declare(strict_types=1);

#%{Namespace}

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use raklib\protocol\AdvertiseSystem;

class Main extends PluginBase {

	$name = 'TEssentials';

	public function onEnable() : void{
		$this->getLogger()->info('Loading...');
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		$plr = $sender->getServer()::getPlayerExact($sender->getName());
		switch($command->getName()){
			case "spawn":
				$sender->sendMessage('Teleporting to spawn...');
				$plr->setPosition($plr->getSpawn());
				return true;
			default:
				return false;
		}
	}

	public function onDisable() : void{
		$this->getLogger()->info('Shutting down...');
	}
}