<?php

namespace App\Entity;

use App\Repository\PoseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoseRepository::class)]
class Pose
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $num = null;

    #[ORM\Column(length: 255)]
    private ?string $pose = null;

    #[ORM\Column(length: 1000, nullable: true)]
    private ?string $memo = null;

    #[ORM\Column(length: 255)]
    private ?string $pose_type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(?int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function getPose(): ?string
    {
        return $this->pose;
    }

    public function setPose(string $pose): self
    {
        $this->pose = $pose;

        return $this;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): self
    {
        $this->memo = $memo;

        return $this;
    }

    public function getPoseType(): ?string
    {
        return $this->pose_type;
    }

    public function setPoseType(string $pose_type): self
    {
        $this->pose_type = $pose_type;

        return $this;
    }
}
