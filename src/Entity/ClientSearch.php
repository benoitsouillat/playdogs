<?php
    namespace App\Entity;

    class ClientSearch {


        /**
         * @var string|null
         */
        private $dogName;


        /**
         * @var string|null
         */
        private $owner;

        /**
         * @var string|null
         */
        private $race;



        /**
         * Get the value of race
         * @return  string|null
         */ 
        public function getRace()
        {
                return $this->race;
        }

        /**
         * Set the value of race
         * @param  string|null  $race
         *
         * @return  self
         */ 
        public function setRace($race)
        {
                $this->race = $race;

                return $this;
        }

        /**
         * Get the value of owner
         * @return  string|null
         */ 
        public function getOwner()
        {
                return $this->owner;
        }

        /**
         * Set the value of owner
         *
         * @param  string|null  $owner
         *
         * @return  self
         */ 
        public function setOwner($owner)
        {
                $this->owner = $owner;

                return $this;
        }

        /**
         * Get the value of dogName
         *
         * @return  string|null
         */ 
        public function getDogName()
        {
                return $this->dogName;
        }

        /**
         * Set the value of dogName
         *
         * @param  string|null  $dogName
         *
         * @return  self
         */ 
        public function setDogName($dogName)
        {
                $this->dogName = $dogName;

                return $this;
        }
    }

?>