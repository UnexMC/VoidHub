<?php

namespace Pxssiii\VoidHUB;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\math\Vector3;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\utils\{Config, TextFormat as TF};

class Main extends PluginBase implements Listener {

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info(TF::GREEN . "[VoidHUB]" . TF::YELLOW . " Plugin enabled by Pxssiii");
    $this->saveDefaultConfig();
	}

	public function onLoad(){
		$this->saveResource("config.yml");  
  }

	public function onDisable() {
		$this->getServer()->getLogger()->info(TF::GREEN . "[VoidHUB]" . TF::YELLOW . " Plugin disabled by Pxssiii..");
	}
	
	public function onMove(PlayerMoveEvent $event) {
		if($event->getPlayer()->getY() < -10) {
			$event->getPlayer()->teleport($this->getServer()->getLevelbyName("Spawn")->getSafeSpawn());
   }
	}
	
	public function onDamage(EntityDamageEvent $event) {
		if($event->getEntity() instanceof Player && $event->getEntity()->getY() < 0) {
			$event->setCancelled();
		}
	}
}
