<?php

namespace Entities;

use Doctrine\Common\Collections\ArrayCollection;

require_once(APPPATH."models/Entities/EntitySuperClass.php");
require_once(APPPATH."models/Entities/Login.php");
require_once(APPPATH."models/Entities/School.php");

/**
 * SchoolAdmin
 *
 * @Table(name="school_admin")
 * @Entity
 */
class SchoolAdmin extends EntitySuperClass {
	/**
	 * @var integer
	 *
	 * @Column(name="id", type="integer", nullable=false)
	 * @Id
	 * @GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var integer
	 *
	 * @OneToOne(targetEntity="Login", cascade={"persist", "remove"})
	 * @JoinColumn(name="login_id", referencedColumnName="id")
	 */
	protected $login;

	/**
	 * @var integer
	 *
	 * @ManyToOne(targetEntity="School", inversedBy="school_admin", cascade={"persist"})
	 * @JoinColumn(name="school_id", referencedColumnName="id", nullable=false)
	 **/
	protected $school;

	/**
	 * @var string
	 *
	 * @Column(name="first_name", type="string", nullable=true)
	 */
	protected $first_name;

	/**
	 * @var string
	 *
	 * @Column(name="last_name", type="string", nullable=true)
	 */
	protected $last_name;

	/**
	 * @var \DateTime
	 *
	 * @Column(name="created_on", type="datetime", nullable=false)
	 */
	protected $created_on;

	/**
	 * @var \DateTime
	 *
	 * @Column(name="last_updated", type="datetime", nullable=false)
	 */
	protected $last_updated;

	public function __construct() {
		$this->created_on = new \DateTime('now');
		$this->last_updated = new \DateTime('now');
	}

	public function getData() {
		return array(
			'id' => $this->id,
			'login_id' => $this->login->__get('id'),
			'email' => $this->login->__get('email'),
			'username' => $this->login->__get('username'),
			'token' => $this->login->__get('token'),
			'school_id' => $this->school->__get('id'),
			'first_name' => $this->first_name,
			'last_name' => $this->last_name,
			'created_on' => $this->created_on,
			'last_updated' => $this->last_updated
		);
	}
}
