<?php

declare(strict_types=1);

namespace TEssentials;

use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use raklib\protocol\AdvertiseSystem;

class Main extends PluginBase {
	public function onEnable() : void{}

	public function onPlayerLogin(Player $player) : void{
		if (!$player->hasPlayedBefore()) {
			//Set Default Spawn
			$pos = new Vector3(0, 70, 0);
			$player->setSpawn($pos);
			unset($pos);
			//Broadcast Welcome Message
			$player->getServer()->broadcast('Welcome '+$player->getName()+' to '+$player->getServer()->getName()+'!');
		}
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
			case 'spawn':
				if ($sender->hasPermission('TEssentials.warp.spawn')){
					$sender->sendMessage('Teleporting to spawn...');
					$sender->getServer()->getPlayerExact($sender->getName())->setPosition($sender->getSpawn());
				}
				return true;
			default:
				return false;
		}
	}

	public function onDisable() : void{
		$this->getLogger()->info('Shutting down...');
	}
}