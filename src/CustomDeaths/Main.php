<?php

namespace CustomDeaths;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Utils;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;
use pocketmine\Player;
use pocketmine\inventory\PlayerInventory;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Server;
use pocketmine\entity\Effect;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerDeathEvent;

	class Main extends PluginBase implements Listener{
		
		public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->getLogger()->info("Version: 1.0.0 for API: 3.0.0");
		}

		public function onDeath(PlayerDeathEvent $event){
		$message = $this->getConfig()->get("message");
		$ent = $event->getEntity();
		$cause = $ent->getLastDamageCause();
		  if($cause instanceof EntityDamageByEntityEvent){
		$killer = $cause->getDamager();
		$weapon = $killer->getInventory()->getItemInHand()->getName();
		$health = $killer->getHealth();
		$death = str_replace(["{player}", "{killer}", "{line}", "{weapon}", "{health}"], [$ent->getName(), $killer->getName(), "\n", $weapon, $health], $message);
		$event->setDeathMessage($death);
		  }
		}
	
	}
