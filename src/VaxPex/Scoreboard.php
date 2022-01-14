<?php

declare(strict_types=1);

namespace VaxPex;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\plugin\PluginBase;

class Scoreboard extends PluginBase implements Listener{

	private static Scoreboard $instance;

	public array $scoreboards = []; // not private cuz it can be used in the plugins

	public function onEnable(){
		self::$instance = $this;
		$this->saveResource("action_scoreboard.mcpack");
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$manager = $this->getServer()->getResourcePackManager();
		$pack = new ZippedResourcePack($this->getDataFolder() . "action_scoreboard.mcpack");
		$reflection = new \ReflectionClass($manager);
		$property = $reflection->getProperty("resourcePacks");
		$property->setAccessible(true);
		$currentResourcePacks = $property->getValue($manager);
		$currentResourcePacks[] = $pack;
		$property->setValue($manager, $currentResourcePacks);
		$property = $reflection->getProperty("uuidList");
		$property->setAccessible(true);
		$currentUUIDPacks = $property->getValue($manager);
		$currentUUIDPacks[strtolower($pack->getPackId())] = $pack;
		$property->setValue($manager, $currentUUIDPacks);
		$property = $reflection->getProperty("serverForceResources");
		$property->setAccessible(true);
		$property->setValue($manager, false);
	}

	public function onDisable(){
		foreach($this->getServer()->getOnlinePlayers() as $player){
			$this->remove($player);
		}
	}

	public static function getInstance() : self{
		return self::$instance;
	}

	public function create(string $objectiveName, string $name, Player $player, string $lines){
		if(isset($this->scoreboards[$player->getName()])){
			$player->removeTitles();
		}
		$this->scoreboards[$player->getName()] = $objectiveName;
		$player->sendTitle(" ". $name . "\n§r§f " . $lines);
	}

	public function remove(Player $player){
		if(isset($this->scoreboards[$player->getName()])){
			$player->removeTitles();
			unset($this->scoreboards[$player->getName()]);
		}
	}

	public function omQuit(PlayerQuitEvent $event){
		$this->remove($event->getPlayer());
	}
}
